<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Telegram\TelegramExtendSocialite;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\URL;


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
    public function boot()
{
    Socialite::extend('telegram', function ($app) {
        $config = $app['config']['services.telegram'];
        return Socialite::buildProvider(\SocialiteProviders\Telegram\Provider::class, $config);
    });

    if (app()->environment('production') || app()->environment('local')) {
        URL::forceScheme('https');
    }
}

}
