<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookOverdueNotification extends Notification
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
            "messages"=>"Vous êtes en retard pour le retour du livre: {$this->loan->book->titre}. Une pénalité de {$this->loan->penality_amount} sera appliquée tous les jours.",
            'book_id' => $this->loan->book->id,
            'loan_id' => $this->loan->id,

        ];
    }
}
