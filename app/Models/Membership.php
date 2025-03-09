<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Membership extends Model
{
    use HasTranslations, SoftDeletes;
    public $translatable = ['name'];
    protected $guarded = ['id'];

    public function prices(): HasMany
    {
        return $this->hasMany(MembershipPrice::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'membership_feature');
    }

    public function durations(): HasMany
    {
        return $this->hasMany(MembershipDuration::class);
    }
}
