<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function dashboard()
    {
        $upcomingEvents = auth()->user()->events()
            ->where('starts_at', '>', now())
            ->latest()
            ->take(5)
            ->get();

        $subscribedEvents = auth()->user()->subscribedEvents()
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'upcomingEvents' => $upcomingEvents,
            'subscribedEvents' => $subscribedEvents
        ]);
    }

    public function preferences()
    {
        return Inertia::render('Preferences', [
            'preferences' => auth()->user()->preferences ?? new UserPreference
        ]);
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'interested_event_types' => 'nullable|array',
            'preferred_location' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'receive_email_notifications' => 'boolean'
        ]);

        auth()->user()->preferences()->updateOrCreate([], $validated);

        return redirect()->route('preferences')->with('success', 'Preferences updated successfully');
    }
}
