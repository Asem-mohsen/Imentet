<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collection_locations');
    }

    public function visitTickets(): HasMany
    {
        return $this->hasMany(VisitTicket::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }
}
