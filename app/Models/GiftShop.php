<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class GiftShop extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = ['id'];
    public $translatable = ['name' , 'location'];

    public function items(): HasMany
    {
        return $this->hasMany(GiftShopItem::class , 'gift_shop_id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function shopItems()
    {
        return $this->belongsToMany(ShopItem::class, 'gift_shop_items')->withTimestamps();
    }
}
