<?php  namespace VaahCms\Themes\MyTheme\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use VaahCms\Themes\MyTheme\Models\MyThemeRegistration;
use VaahCms\Themes\MyTheme\Models\MyThemeUser;

class ActivationLinkNotification extends Notification {

    use Queueable;
    public $registration;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MyThemeRegistration $registration)
    {
        $this->registration = $registration;
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
        return (new MailMessage)
            ->line('Please click to activate your account')
            ->action(
                'Activate',
                route(
                    'vh.frontend.mytheme.signup.activate',
                    [$this->registration->activation_code]
                )
            )
            ->line('Thank you for using our application!');
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
