<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTicket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'visit_date' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visitTicket(): BelongsTo
    {
        return $this->belongsTo(VisitTicket::class);
    }
}
