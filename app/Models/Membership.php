<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Membership extends Model implements HasMedia
{
    use HasTranslations, SoftDeletes , InteractsWithMedia;
    public $translatable = ['name' , 'description' , 'title'];
    protected $guarded = ['id'];
    public static bool $skipDurationSaving = false;


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($membership) {
            if (!self::$skipDurationSaving) {
                self::handleDurationSaving($membership);
            }
        });

        static::updating(function ($membership) {
            if (!self::$skipDurationSaving) {
                self::handleDurationSaving($membership);
            }
        });
    }

    public function prices(): HasMany
    {
        return $this->hasMany(MembershipPrice::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_memberships', 'membership_id', 'user_id')->withTimestamps();
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'membership_feature');
    }

    public function durations()
    {
        return $this->hasMany(MembershipDuration::class);
    }

    // ------------------------------------------------------------------------------------------------------------------------

    private static function handleDurationSaving($membership)
    {
        $selectedDuration = request()->input('selected_duration');
        $customDurations = request()->input('custom_durations', []);

        // Predefined translations
        $translations = [
            'week' => ['en' => 'Week', 'ar' => 'أسبوع'],
            'monthly' => ['en' => 'Monthly', 'ar' => 'شهري'],
            'yearly' => ['en' => 'Yearly', 'ar' => 'سنوي'],
            'open' => ['en' => 'Open', 'ar' => 'مفتوح'],
            'semi-annual' => ['en' => 'Semi-Annual', 'ar' => 'نصف سنوي'],
            'lifetime' => ['en' => 'Lifetime', 'ar' => 'مدى الحياة'],
        ];

        // Clear old durations
        $membership->durations()->delete();

        // If predefined duration is selected
        if (isset($translations[$selectedDuration])) {
            $membership->durations()->create([
                'duration' => $translations[$selectedDuration],
            ]);
        }

        // If custom durations are entered
        foreach ($customDurations as $custom) {
            $membership->durations()->create([
                'duration' => [
                    'en' => $custom['en'],
                    'ar' => $custom['ar'],
                ],
            ]);
        }
    }
}
