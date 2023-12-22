<?php

namespace App\Notifications\Admin;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PendingBooking extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public \App\Models\Booking $booking)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
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
                    ->subject('A new booking has been made!')
                    ->line("{$this->booking->client->name} has book {$this->booking->accommodation->name}")
                    ->line('Check In: ' . Carbon::parse($this->booking->check_in)->format('F d,Y h:i:s A'))
                    ->line('Check Out: ' . Carbon::parse($this->booking->check_out)->format('F d,Y h:i:s A'))
                    ->line('Person: ' . $this->booking->person_quantity);
    }
}
