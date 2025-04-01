<?php 
namespace App\Services;

use App\Models\Event;
use App\Repositories\{EventRepository, PaymentRepository, PlaceRepository};

class EventService
{
    public function __construct(
        protected EventRepository $eventRepository, 
        protected PlaceRepository $placeRepository,
        protected PaymentRepository $paymentRepository
        )
    {
        $this->eventRepository = $eventRepository;
        $this->placeRepository = $placeRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllGEMEvents($categoryName = null, $placeId = null, ?int $paginate = 9, array $excludeCategories = [])
    {
        $where = [];

        if ($categoryName && $categoryName !== 'exhibitions') {

            $eventCategory = $this->eventRepository->findBy(['name->en' => $categoryName]);

            if ($eventCategory) {
                $where['event_category_id'] = $eventCategory->id;
            }
        }

        if ($placeId && $placeId !== 0) {
            $where['place_id'] = $placeId;
        }

        $events     = $this->eventRepository->getAllEvents(placeName:'Grand Egyptian Museum', where: $where,paginate: $paginate, excludeCategories: ['Exhibitions']);
        $categories = $this->eventRepository->getCategories(excludeNames: $excludeCategories);
        $places     = $this->placeRepository->getAllPlaces();

        return get_defined_vars();
    }

    public function showEvent(int $id): array
    {
        $event = $this->eventRepository->findById($id);
        $paginationEvents = $this->eventRepository->paginationEventsShow($id);
    
        return array_merge(['event' => $event], $paginationEvents);
    }

    public function getExhibitions()
    {
        $events = $this->eventRepository->getExhibitionEvents();
        return [
            'currentExhibitions' => $events['current'],
            'upcomingExhibitions' => $events['upcoming'],
            'pastExhibitions' => $events['past'],
        ];
    }

    public function bookEvent(array $validatedData, Event $event, int $userId)
    {
        $totalAmount = 0;
        $paymentItems = [];

        foreach ($validatedData['quantities'] as $category => $prices) {
            foreach ($prices as $type => $quantity) {
                if ($quantity > 0) {
                    $price = $this->eventRepository->getPriceByCategory($event, $category);

                    if ($price) {
                        $ticketPrice = match ($type) {
                            'egyptian' => $price->price_egyptian,
                            'arab' => $price->price_arab,
                            'foreigner' => $price->price_foreigner,
                            default => 0,
                        };

                        $paymentItems[] = [
                            'payable_type' => Event::class,
                            'payable_id' => $event->id,
                            'quantity' => $quantity,
                            'price' => $ticketPrice,
                        ];
                        $totalAmount += $quantity * $ticketPrice;
                    }
                }
            }
        }

        if ($totalAmount <= 0) {
            return ['error' => 'Please select at least one valid ticket.'];
        }

        $payment = $this->paymentRepository->createPayment([
            'user_id' => $userId,
            'amount' => $totalAmount,
            'status' => 'pending',
            'transaction_id' => null,
        ]);

        foreach ($paymentItems as $item) {
            $item['payment_id'] = $payment->id;
            $this->paymentRepository->createPaymentItem($item);
        }

        return ['payment_id' => $payment->id];
    }
}