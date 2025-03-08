<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];

    public $translatable = ['name'];

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'membership_feature');
    }
}
