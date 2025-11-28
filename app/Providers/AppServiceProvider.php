<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            App\Events\CuttingEvent::class,
            App\Listeners\CuttingListener::class,
            App\Events\InscriptionEvent::class,
            App\Listeners\InscriptionListener::class,
        );
    }
}
