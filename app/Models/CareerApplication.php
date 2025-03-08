<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerApplication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
