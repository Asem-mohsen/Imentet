<?php 
namespace App\Services;

use App\Repositories\ShopItemsRepository;

class ShopItemsService
{
    public function __construct(protected ShopItemsRepository $shopItemsRepository)
    {
        $this->shopItemsRepository = $shopItemsRepository;
    }

    public function getProducts($perPage = 10)
    {
        return $this->shopItemsRepository->ShopItems($perPage);
    }

    public function getSortedProducts(string $sortOption = 'default', int $perPage = 12)
    {
        return $this->shopItemsRepository->getSortedItems($sortOption, $perPage);
    }
    
    public function getProduct(int $productId)
    {
        return $this->shopItemsRepository->findById($productId);
    }
}
