<?php 
namespace App\Repositories;

use App\Models\ShopItem;

class ShopItemsRepository
{
    public function ShopItems($perPage = 10)
    {
        return ShopItem::with(['sale'])->paginate($perPage);
    }

    public function getAllShopItems()
    {
        return ShopItem::with(['sale'])->get()->map(function ($item) {
            $item->final_price = $item->sale ? $item->sale->discounted_price : $item->price;
            return $item;
        });
    }

    public function findById(int $id)
    {
        $item = ShopItem::with(['sale'])->findOrFail($id);
        $item->final_price = $item->sale ? $item->sale->discounted_price : $item->price;
        return $item;
    }

    public function getSortedItems(string $sortOption, int $perPage = 12)
    {
        $query = ShopItem::with('sale');

        switch ($sortOption) {
            case '1': // Top Selling
                $query->orderByDesc('sales_count');
                break;

            case 'ASC': // Lowest Price
                $query->orderBy('price');
                break;

            case 'DESC': // Highest Price
                $query->orderByDesc('price');
                break;

            default: // Default
                // no ordering applied
                break;
        }

        return $query->paginate($perPage);
    }

    public function getAvailableForSale()
    {
        return ShopItem::whereDoesntHave('sale', function ($query) {
            $query->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
        })->get();
    }
}