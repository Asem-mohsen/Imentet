<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Career extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }
}
