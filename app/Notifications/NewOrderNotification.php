<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    //$notifiable object from use model
    {
        return (new MailMessage)
                    ->subject('New Order #'. $this->order->id)
                    ->greeting('Welcome ' . $notifiable->name)
                    ->line('A new order has been created.')
                    ->action(' View Order ', route('orders.show', $this->order->id))
                    ->line('Thank you! ');
    }
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'body' => "A new order #{$this->order->id} has been created. from{ $notifiable->name}",
            'icon' => 'fas fa-envelope',
            'link' => route('orders.show', $this->order->id) ,
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
