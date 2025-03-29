<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Collection extends Model implements HasMedia
{
    use HasFactory, HasTranslations, SoftDeletes , InteractsWithMedia;
    protected $guarded = ['id'];
    public $translatable = ['name' , 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CollectionCategory::class, 'category_id');
    }

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'collection_locations');
    }


    public function getPlaceNames($onlyOne = false): string
    {
        $places = $this->places;

        if ($onlyOne) {
            return optional($places->first())->name ?? '';
        }

        return $places->pluck('name')->implode(' - ');
    }
}
