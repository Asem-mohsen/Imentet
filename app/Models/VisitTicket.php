<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class VisitTicket extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = ['id'];
    public $translatable = ['ticket_type', 'location'];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}