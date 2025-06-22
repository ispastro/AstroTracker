<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function preferences(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(EventSubscription::class);
    }

    public function createdEvents(): HasMany
    {
        return $this->hasMany(CelestialEvent::class);
    }

    public function subscribedEvents(): HasManyThrough
    {
        return $this->hasManyThrough(
            CelestialEvent::class, 
            EventSubscription::class,
            'user_id', // foreign key in subscriptions table
            'id',     // local key in events table
            'id',     // local key in users table
            'celestial_event_id' // foreign key in subscriptions table
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
}
