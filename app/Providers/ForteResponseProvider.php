<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ForteResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('forte', function ($code, $message, $data = null) {
            return Response::json([
                'response' => [
                    'code' => $code,
                    'message' => $message
                ],
                'data' => $data
            ]);
        });
    }
}
