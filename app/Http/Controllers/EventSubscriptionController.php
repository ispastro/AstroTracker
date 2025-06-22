<?php

namespace App\Http\Controllers;

use App\Models\CelestialEvent;
use App\Models\EventSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventSubscriptionController extends Controller
{
    public function store(CelestialEvent $event)
    {
        $event->subscriptions()->create([
            'user_id' => Auth::id()
        ]);

        return back();
    }

    public function destroy(CelestialEvent $event)
    {
        EventSubscription::where('user_id', Auth::id())
            ->where('celestial_event_id', $event->id)
            ->delete();

        return back();
    }
}
