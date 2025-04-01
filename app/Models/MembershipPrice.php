<?php

namespace App\Models;

use App\Enums\MembershipDuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipPrice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'duration' => MembershipDuration::class,
    ];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function visitorType(): BelongsTo
    {
        return $this->belongsTo(VisitorType::class);
    }
}
