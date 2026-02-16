<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Example extends Notification
{
    use Queueable;

    public ?string $unsubscribe;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $subject = 'Example Notification')
    {
        $this->unsubscribe = 'https://google.com/unsubscribe';
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
            ->subject($this->subject)
            ->view('mail.example', [
                'unsubscribe' => $this->unsubscribe,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
