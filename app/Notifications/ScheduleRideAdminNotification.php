<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScheduleRideAdminNotification extends Notification
{
    use Queueable;

    protected $arr;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($arr,$email)
    {
        $this->arr = $arr;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $ride = $this->arr;
        $notifiable->email = $this->email;
        //dd($notifiable->toArray());
        return (new MailMessage)
            ->line($notifiable->name.' scheduled the ride. Ride time is ('.date('d M Y h:i a',strtotime($ride->ride_date)).').');
            //->action('Notification Action', url('/'))
            //->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
