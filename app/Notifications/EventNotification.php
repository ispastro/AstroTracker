<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class EventNotification
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('/events/' . $this->event->id);

        return (new MailMessage)
            ->subject('Upcoming Celestial Event: ' . $this->event->title)
            ->line('The celestial event you subscribed to is happening soon!')
            ->line($this->event->description)
            ->line('Event Type: ' . ucwords(str_replace('_', ' ', $this->event->type)))
            ->line('Start Time: ' . $this->event->starts_at->format('F j, Y, g:i A'))
            ->action('View Event', $url)
            ->line('Thank you for using AstroTracker!');
    }
}
