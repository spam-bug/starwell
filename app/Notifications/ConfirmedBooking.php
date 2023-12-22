<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmedBooking extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public \App\Models\Booking $booking)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Your booking has been confirmed!')
                    ->line("Hi {$notifiable->name},")
                    ->line("Your {$this->booking->accommodation->name} has been confirmed. A down payment is required to complete your booking.");
    }
}
