<?php 
namespace App\Services\Museum;

use App\Repositories\{CollectionRepository};

class CollectionService
{
    public function __construct(
        protected CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function getCollections()
    {
        return $this->collectionRepository->getAllCollections();
    }

    public function getCategoriesWithCollections(?string $slug = null , ?int $limit = null)
    {
        return $this->collectionRepository->getCategoriesWithCollections($slug ,limit: $limit);
    }

    public function getCollection(int $id)
    {
        return $this->collectionRepository->findById($id);
    }

    public function getCategories()
    {
        return $this->collectionRepository->getCategories();
    }

    public function getAdjacentCollections(int $collectionId): array
    {
        return [
            'prev' => $this->collectionRepository->getAdjacentCollection($collectionId, 'prev'),
            'next' => $this->collectionRepository->getAdjacentCollection($collectionId, 'next'),
        ];
    }
}