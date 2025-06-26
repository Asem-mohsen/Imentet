<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
class MembershipDuration extends Model 
{
    use HasTranslations;
    public $translatable = ['duration'];
    protected $guarded = ['id'];
    protected $table = 'membership_durations';
    
    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
