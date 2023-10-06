<?php

namespace App\Listeners;

use App\Events\UserCreationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPasswordMail;
use App\Mail\ForgotPassword;

class SendUserWelcomeMail implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreationEvent  $event
     * @return void
     */
    public function handle(UserCreationEvent $event)
    {
       
        $user = $event->user;
        $email = $user['email'];
        Mail::to($email)->send(new UserPasswordMail($user));
    }
}
