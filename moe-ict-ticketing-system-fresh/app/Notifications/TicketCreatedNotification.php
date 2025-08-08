<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(public Ticket $ticket) {}

    public function via(object $notifiable): array
    {
        return ['database']; // add 'mail' if mail is configured
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Ticket Assigned: ' . $this->ticket->ticket_no)
            ->line('A new ticket has been assigned to you.')
            ->line('Priority: ' . ($this->ticket->priority ?? 'Normal'))
            ->line('Issue: ' . $this->ticket->issue)
            ->action('View Ticket', url(route('tickets.show', $this->ticket->id)));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_no' => $this->ticket->ticket_no,
            'priority' => $this->ticket->priority,
            'message' => 'New ticket assigned',
        ];
    }
}
