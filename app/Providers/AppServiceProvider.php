<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Response;

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
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->view('mail.verification', [
                    'user' => $notifiable,
                    'url' => $url
                ]);
        });

        Response::macro('success', function ($data = null, string $message = 'Success', int $status = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data,
            ], $status);
        });

        Response::macro('error', function (string $message = 'Error', int $status = 400, $errors = null) {
            $res = [
                'success' => false,
                'message' => $message,
            ];

            if ($errors) {
                $res['errors'] = $errors;
            }

            return response()->json($res, $status);
        });
    }
}
