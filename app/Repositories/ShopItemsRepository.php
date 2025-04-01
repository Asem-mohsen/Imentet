<?php 
namespace App\Repositories;

use App\Models\ShopItem;

class ShopItemsRepository
{
    public function ShopItems($perPage = 10)
    {
        return ShopItem::paginate($perPage);
    }

    public function findById(int $id)
    {
        return ShopItem::findOrFail($id);
    }
}