<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\NewOrderReceived;
use App\Events\UserCreationEvent;
use App\Listeners\NewOrderReceivedListener;
use App\Listeners\SendUserWelcomeMail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        NewOrderReceived::class => [
            NewOrderReceivedListener::class,
        ],
        UserCreationEvent::class => [
            SendUserWelcomeMail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}