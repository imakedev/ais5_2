<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Log;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];
    /*
    protected $listen = [
        'Illuminate\Auth\Events\Attempting' => [
            'App\Listeners\LogAuthenticationAttempt',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
        ],
    ];
    */
    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
        // Fired on each authentication attempt...
        $events->listen('auth.attempt', function ($credentials, $remember, $login) {
            //
        });

        // Fired on successful logins...
        $events->listen('auth.login', function ($user, $remember) {
            //
            Log::info('into Event login  ['.$user->empId.']');
        });

        // Fired on logouts...
        $events->listen('auth.logout', function ($user) {
            //
            Log::info('into Event logout  ['.$user->empId.']');
        });
    }
}
