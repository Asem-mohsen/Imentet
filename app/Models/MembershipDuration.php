<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipDuration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
