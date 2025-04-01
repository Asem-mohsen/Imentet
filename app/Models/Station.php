<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Station extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];
    public $translatable = ['name', 'description'];

    public function startTransportations(): HasMany
    {
        return $this->hasMany(Transportation::class, 'start_station_id');
    }

    public function endTransportations(): HasMany
    {
        return $this->hasMany(Transportation::class, 'end_station_id');
    }
}
