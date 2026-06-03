<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookReturnedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $loan)
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
        return ['database'];
    }

    public function toDatabase()
    {
        return[
            'message'=>"Vous avez retourné le livre : {$this->loan->book->titre}  le {$this->loan->returned_at->format('d/m/Y') }. Merci pour avoir utilisé nos services et à bientôt.",
            'book_id' => $this->loan->book->id,
            'loan_id' => $this->loan->id,
        ];
    }

    
}
