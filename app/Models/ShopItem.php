<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ShopItem extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = ['id'];
    public $translatable = ['name', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ShopItemCategory::class, 'category_id');
    }

    public function giftShops()
    {
        return $this->belongsToMany(GiftShop::class, 'gift_shop_items');
    }
    
    public function sale()
    {
        return $this->hasOne(Sale::class , 'shop_item_id')->wherePast('start_date')->whereFuture('end_date');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(UserReview::class);
    }
}
