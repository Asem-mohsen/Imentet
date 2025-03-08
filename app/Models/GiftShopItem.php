<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelPackageTools\Concerns\Package\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GiftShopItem extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = ['id'];

    public function shopItem(): BelongsTo
    {
        return $this->belongsTo(ShopItem::class);
    }

    public function giftShop(): BelongsTo
    {
        return $this->belongsTo(GiftShop::class);
    }
}
