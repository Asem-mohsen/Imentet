<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transportation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function startStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'start_station_id');
    }

    public function endStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'end_station_id');
    }
}
