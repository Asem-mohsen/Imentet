<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class CollectionCategory extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];
    public $translatable = ['name' , 'description'];

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class , 'category_id');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }
}
