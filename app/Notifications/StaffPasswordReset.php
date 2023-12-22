<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffPasswordReset extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $password)
    {

    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Password Reset')
                    ->greeting("Hi {$notifiable->name},")
                    ->line('Your password has been reset.')
                    ->line("New Password: {$this->password}")
                    ->line('If you did not request this password reset, please contact your administrator.');
    }
}
