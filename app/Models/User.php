<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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

    public function membership()
    {
        return $this->hasOne(UserMembership::class);
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

    public function userReviews(): HasMany
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
}
