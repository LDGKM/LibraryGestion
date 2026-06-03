<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookBorrowedNotification extends Notification
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

    public function toDatabase(object $notifiable)
    {
        return[
            'message'=> "Vous avez emprunté le livre : {$this->loan->book->titre}",
            'book_id' => $this->loan->book->id,
            'loan_id' => $this->loan->id,
            'due_at' => $this->loan->due_at->format('d/m/Y'),
        ];
    }

}
