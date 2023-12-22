<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DefaultPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $password)
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
                    ->subject("Welcome to the team!")
                    ->greeting("Hi {$notifiable->name}")
                    ->line("Welcome to the team!")
                    ->line("Your credentials are:")
                    ->line("Username: {$notifiable->username}")
                    ->line("Password: {$this->password}")
                    ->action('Log In Now', route('home'));
    }
}
