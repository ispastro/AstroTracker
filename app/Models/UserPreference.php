<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'interested_event_types',
        'preferred_location',
        'latitude',
        'longitude',
        'receive_email_notifications'
    ];

    protected $casts = [
        'interested_event_types' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'receive_email_notifications' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
