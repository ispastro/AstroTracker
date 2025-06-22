<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSubscription extends Model
{
    protected $fillable = ['user_id', 'celestial_event_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(CelestialEvent::class, 'celestial_event_id');
    }
}
