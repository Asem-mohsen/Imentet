<?php

namespace App\Filament\Widgets;

use App\Models\VisitTicket;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use App\Services\Filament\Calculations;

class TicketPaymentsChart extends ChartWidget
{
    protected static ?string $heading = 'Ticket Payments by Place';
    protected static ?string $description = 'Shows total ticket payments over time grouped by place';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        return Cache::remember('ticket_payments_chart', 3600, function () {
            $paymentItems = app(Calculations::class)->getTotalAmountGroupedByDateAndPlace(VisitTicket::class);

            // Load place_id for payable_ids (visit_ticket_ids)
            $ticketPlaces = VisitTicket::with('place')
                ->whereIn('id', $paymentItems->pluck('payable_id')->unique())
                ->get()
                ->keyBy('id');

            $dates = $paymentItems->pluck('date')->unique()->sort()->values();

            $places = $ticketPlaces->pluck('place.name', 'place.id')->unique();

            $datasets = [];

            foreach ($places as $placeId => $placeName) {
                $datasets[] = [
                    'label' => $placeName,
                    'data' => $dates->map(function ($date) use ($paymentItems, $ticketPlaces, $placeId) {
                        return $paymentItems->filter(function ($item) use ($date, $ticketPlaces, $placeId) {
                            $ticket = $ticketPlaces->get($item->payable_id);
                            return $item->date === $date && $ticket && $ticket->place_id === $placeId;
                        })->sum('total_amount');
                    })->toArray(),
                ];
            }

            return [
                'datasets' => $datasets,
                'labels' => $dates->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Total Amount (EGP)'
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Date'
                    ]
                ]
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
        ];
    }
} 