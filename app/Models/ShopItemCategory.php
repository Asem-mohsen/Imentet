<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ShopItemCategory extends Model
{
    use HasFactory , HasTranslations;
    protected $guarded = ['id'];
    public $translatable = ['name'];

    public function items()
    {
        return $this->hasMany(ShopItem::class);
    }
}
