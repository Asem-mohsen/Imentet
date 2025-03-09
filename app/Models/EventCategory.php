<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class EventCategory extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];
    public $translatable = ['name'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
