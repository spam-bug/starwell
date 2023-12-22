<?php

namespace App\Notifications\Admin;

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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('A booking has been confirmed!')
                    ->line("The booking that has been made by {$this->booking->client->name} has been confirmed and awaiting a down payment.");
    }
}
