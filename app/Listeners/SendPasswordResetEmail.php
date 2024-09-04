<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmail
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event)
    {
        $admin = $event->admin;

        // Send the email
        Mail::send('emails.password_reset', ['code' => $admin->verefacation_code,'admin' => $admin], function ($message) use ($admin) {
            $message->to($admin->email);
            $message->subject('Password Reset Request');
        });
    }
}
