<?php 
namespace App\Services;

use App\Repositories\CollectionRepository;

class CollectionService
{
    public function __construct(
        protected CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function getCollections(string $placeName, ?int $limit = null)
    {
        return $this->collectionRepository->getAllCollections($placeName,limit: $limit);
    }

    public function getCategoriesWithCollections(string $placeName, ?string $slug = null , ?int $limit = null)
    {
        return $this->collectionRepository->getCategoriesWithCollections(placeName: $placeName, slug: $slug ,limit: $limit);
    }

    public function getCollection(int $id)
    {
        return $this->collectionRepository->findById($id);
    }

    public function getCategories()
    {
        return $this->collectionRepository->getCategories();
    }

    public function getAdjacentCollections(int $collectionId, string $placeName): array
    {
        return [
            'prev' => $this->collectionRepository->getAdjacentCollection($collectionId, 'prev', $placeName),
            'next' => $this->collectionRepository->getAdjacentCollection($collectionId, 'next', $placeName),
        ];
    }
}