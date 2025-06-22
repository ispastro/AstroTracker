<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CelestialEvent;
use App\Models\User;
use App\Notifications\EventNotification;
use Carbon\Carbon;

class CheckUpcomingEvents extends Command
{
    protected $signature = 'events:check-upcoming';
    protected $description = 'Check for upcoming events and notify subscribed users';

    public function handle()
    {
        // Get events starting in the next 24 hours
        $upcomingEvents = CelestialEvent::whereBetween('starts_at', [
            now(),
            now()->addHours(24)
        ])->get();

        foreach ($upcomingEvents as $event) {
            // Get users who are subscribed to this event
            $subscribedUsers = $event->subscriptions()
                ->with('user')
                ->get()
                ->pluck('user');

            // Filter users who want email notifications
            $usersToNotify = $subscribedUsers->filter(function ($user) {
                return $user->preferences?->receive_email_notifications ?? true;
            });

            // Send notifications
            foreach ($usersToNotify as $user) {
                $user->notify(new EventNotification($event));
            }

            $this->info("Notified " . $usersToNotify->count() . " users about event: " . $event->title);
        }

        return Command::SUCCESS;
    }
}
