<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['place_id', 'donor_name', 'email', 'amount', 'payment_method', 'message'];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
