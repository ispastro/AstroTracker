<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class CelestialEvent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'starts_at',
        'ends_at',
        'visibility_regions',
        'is_global'
    ];

    protected $casts = [
        'visibility_regions' => 'array',
        'is_global' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(EventSubscription::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isVisibleToUser(User $user): bool
    {
        if ($this->is_global) {
            return true;
        }

        if (empty($this->visibility_regions)) {
            return false;
        }

        // Check if user's location matches any visibility region
        $userLocation = $user->preferences?->preferred_location ?? '';
        return in_array($userLocation, $this->visibility_regions);
    }
}
