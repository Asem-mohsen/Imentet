<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FaqCategory extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = ['id'];

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class, 'faq_category_id');
    }
}
