<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelPackageTools\Concerns\Package\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GiftShop extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(GiftShopItem::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
