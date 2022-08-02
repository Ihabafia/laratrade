<?php

namespace App\Notifications;

use App\Models\Communication;
use App\Services\TemplateParser;
use Carbon\Carbon;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use URL;

class ActivateUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Communication $template;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = Communication::whereSlug('new-user-activation-notification-email')->first();
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

    public function toMail($notifiable)
    {
        $vars = [
            'link' => $this->verificationUrl($notifiable),
            'first_name' => $notifiable->first_name,
        ];

        $parser = (new TemplateParser($this->template, $notifiable, $vars));
        $message = $parser->parse();

        $mail = new MailMessage();
        if (config('mail.bcc')) {
            $mail->bcc(config('mail.bcc'));
        }

        return $mail
            ->subject($message->subject)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('mail.general-template', [
                'body' => $message->body,
            ]);
    }


    protected function verificationUrl($notifiable): string
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

