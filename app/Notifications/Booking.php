<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Booking extends Notification implements ShouldQueue
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
                    ->subject('Thank you for booking with us!')
                    ->line("Hi {$notifiable->name},")
                    ->line('Thank you for booking with us! We will notify you once your booking has been confirmed and a down payment should be made.')
                    ->line('Booking Details')
                    ->line('Check In: ' . Carbon::parse($this->booking->check_in)->format('F d,Y h:i:s A'))
                    ->line('Check Out: ' . Carbon::parse($this->booking->check_out)->format('F d,Y h:i:s A'))
                    ->line('How many person: ' . $this->booking->person_quantity);
    }
}
