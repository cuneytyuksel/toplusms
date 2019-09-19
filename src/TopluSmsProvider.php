<?php

namespace Sms\TopluSms;

use Notification;
use Illuminate\Support\ServiceProvider;

class TopluSmsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Notification::extend('sms', function($app)
        {
            $channel = $this->app->make(TopluSmsChannel::class);
            $channel->setConfig(config('services.toplusms'));
            return $channel;
        });
    }
}
