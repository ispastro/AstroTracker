<?php

namespace App\Http\Controllers;

use App\Http\Requests\CelestialEventRequest;
use App\Models\CelestialEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CelestialEventController extends Controller
{
    public function index(Request $request)
    {
        $events = CelestialEvent::query()
            ->when($request->type, fn($query) => $query->where('type', $request->type))
            ->when($request->start_date, fn($query) => $query->where('starts_at', '>=', $request->start_date))
            ->when($request->end_date, fn($query) => $query->where('ends_at', '<=', $request->end_date))
            ->when(auth()->check(), fn($query) => $query->whereHas('subscriptions', fn($query) => $query->where('user_id', auth()->id())))
            ->latest()
            ->paginate(10);

        return Inertia::render('CelestialEvents/Index', [
            'events' => $events,
            'filters' => $request->only(['type', 'start_date', 'end_date'])
        ]);
    }

    public function create()
    {
        return Inertia::render('CelestialEvents/Create', [
            'eventTypes' => ['meteor_shower', 'eclipse', 'planet', 'satellite', 'comet', 'asteroid'],
            'regions' => ['Africa', 'Antarctica', 'Asia', 'Europe', 'North America', 'Oceania', 'South America']
        ]);
    }

    public function store(CelestialEventRequest $request)
    {
        $validated = $request->validated();
        
        // Convert visibility_regions to array if it's a string
        if (isset($validated['visibility_regions']) && is_string($validated['visibility_regions'])) {
            $validated['visibility_regions'] = explode(',', $validated['visibility_regions']);
        }

        $event = CelestialEvent::create($validated);
        
        return redirect()->route('celestial-events.index')
            ->with('success', 'Event created successfully');
    }

    public function edit(CelestialEvent $event)
    {
        return Inertia::render('CelestialEvents/Edit', ['event' => $event]);
    }

    public function update(CelestialEventRequest $request, CelestialEvent $event)
    {
        $event->update($request->validated());
        return redirect()->route('celestial-events.index');
    }

    public function destroy(CelestialEvent $event)
    {
        $event->delete();
        return redirect()->route('celestial-events.index');
    }
}
