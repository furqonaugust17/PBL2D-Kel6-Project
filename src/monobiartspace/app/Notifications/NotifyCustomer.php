<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class NotifyCustomer extends Notification
{
    use Queueable;
    protected $isCreate;
    /**
     * Create a new notification instance.
     */
    public function __construct(bool $isCreate = true)
    {
        $this->isCreate = $isCreate;
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
        return (new MailMessage)->markdown($this->isCreate ? 'mail.customer.create' : 'mail.customer.update', [
            'url' => $this->verificationUrl($notifiable),
            'data' => $notifiable,
        ])->subject($this->isCreate ? 'Verifikasi Email' : 'Informasi Akun Anda Telah Diperbarui');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
