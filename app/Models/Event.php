<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;

class Event extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $guarded = ['id'];

    public $translatable = ['title' , 'description', 'location'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(EventPrice::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(EventReview::class);
    }

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class, 'sponsor_event');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function paymentItems(): HasMany
    {
        return $this->hasMany(PaymentItem::class, 'payable_id')->where('payable_type', self::class);
    }

    public function isHappening()
    {
        $today = Carbon::now();
        $eventEndDate = Carbon::parse($this->end_time);

        return ($today->lessThanOrEqualTo($eventEndDate) || $this->repeated) && !in_array($this->status, ['postponed', 'cancelled', 'banned']);
    }

    public function getSponsorNames(bool $multiple = true): string
    {
        $sponsors = $this->sponsors->pluck('name');

        if ($multiple) {
            return $sponsors->implode(' - '); 
        }

        return $sponsors->first() ?? '';
    }
}
