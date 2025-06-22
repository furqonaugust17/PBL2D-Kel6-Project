<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

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
        if (request()->host() != '127.0.0.1') {
            URL::forceScheme('https');
        }

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)->markdown('mail.customer.create', [
                'url' => $url,
                'data' => $notifiable,
                'email' => 'monobi@gmail.com'
            ])->subject('Verifikasi Email');
        });
    }
}
