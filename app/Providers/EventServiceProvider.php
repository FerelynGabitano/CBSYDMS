<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Helpers\SystemLogHelper;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // ✅ Fires once per actual login (not every page reload)
        Event::listen(Authenticated::class, function ($event) {
            if (!session('logged_once')) { // Prevent duplicate on reload
                SystemLogHelper::log('Login', 'User logged in: ' . $event->user->credential_email);
                session(['logged_once' => true]);
            }
        });

        // ✅ Fires once on logout
        Event::listen(Logout::class, function ($event) {
            SystemLogHelper::log('Logout', 'User logged out: ' . $event->user->credential_email);
            session()->forget('logged_once');
        });
    }
}
