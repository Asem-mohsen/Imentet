<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class EventCategory extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = ['id'];
    public $translatable = ['name' , 'description'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
