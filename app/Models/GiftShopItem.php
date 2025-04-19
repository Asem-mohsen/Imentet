<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GiftShopItem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = ['id'];
    protected $table = 'gift_shop_items';

    public function giftShop(): BelongsTo
    {
        return $this->belongsTo(GiftShop::class);
    }

    public function shopItems(): BelongsToMany
    {
        return $this->belongsToMany(ShopItem::class, 'gift_shop_items', 'gift_shop_id', 'shop_item_id');
    }
}
