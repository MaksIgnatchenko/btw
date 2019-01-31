<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-08
 * Time: 12:24
 */

namespace App\Modules\Users\Customer\Mails;

use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordMail extends ResetPassword
{
    /** @var Customer */
    protected $customer;

    /**
     * ResetPasswordMail constructor.
     * @param string $token
     * @param Customer $customer
     */
    public function __construct(string $token, Customer $customer)
    {
        parent::__construct($token);
        $this->customer = $customer;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $appName = config('app.name');
        return (new MailMessage)
            ->subject(Lang::getFromJson('Reset Password Notification'))
            ->greeting("Hi, {$this->customer->full_name}")
            ->line(Lang::getFromJson("You recently requested to reset your password for {$appName}."))
            ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
            ->line(Lang::getFromJson('Click the button  below to reset it:'))
            ->action(Lang::getFromJson('Reset Password'), url(route('customer.password.reset', $this->token, false)))
            ->line(Lang::getFromJson('This password reset is only valid for the next 24 hours.'))
            ->line(Lang::getFromJson('If you didn\'t request a password reset, please, let us know.'))
            ->salutation("Yours, {$appName} Mobile Team");
    }
}