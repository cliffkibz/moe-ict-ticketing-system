<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketClosedNotification extends Notification
{
    use Queueable;

    public function __construct(public Ticket $ticket) {}

    public function via(object $notifiable): array
    {
        return ['database']; // add 'mail' if configured
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Ticket Closed: ' . $this->ticket->ticket_no)
            ->line('The ticket has been closed.')
            ->line('Resolution time: ' . ($this->ticket->resolution_minutes ?? '—') . ' minutes')
            ->action('View Ticket', url(route('tickets.show', $this->ticket->id)));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_no' => $this->ticket->ticket_no,
            'message' => 'Ticket closed',
            'resolution_minutes' => $this->ticket->resolution_minutes,
        ];
    }
}
