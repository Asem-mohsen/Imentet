<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasName, HasMedia
{
    use HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    public function memberships(): HasMany
    {
        return $this->hasMany(UserMembership::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function userTickets(): HasMany
    {
        return $this->hasMany(UserTicket::class);
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class);
    }

    public function eventReviews(): HasMany
    {
        return $this->hasMany(EventReview::class);
    }

    public function careerApplications()
    {
        return $this->hasMany(CareerApplication::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }



    public function latestActiveMembership($returnAll = false)
    {
        $activeMemberships = $this->memberships()
            ->where('end_date', '>=', now()) // Get only active memberships
            ->with(['membership' => function ($query) {
                $query->withCount('features'); // Count features in the Membership model
            }])
            ->get()
            ->sortByDesc(fn ($membershipUser) => $membershipUser->membership->features_count) // Sort in PHP
            ->sortByDesc('price_id'); // Secondary sort by price_id

        if ($returnAll) {
            return $activeMemberships->map(function ($membershipUser) {
                return "{$membershipUser->membership->name} ({$membershipUser->start_date->format('d M Y')} - {$membershipUser->end_date->format('d M Y')})";
            })->implode(' - ');
        }

        return $activeMemberships->first();
    }
}
