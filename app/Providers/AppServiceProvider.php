<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('api', function (Request $request, array $headers) {
            return Limit::perMinute(10)->by($request->user()?->id ?: $request->ip());
            return response('too many requests.', 429, $headers);
        });

        RateLimiter::for('admin', function (Request $request, array $headers) {
            return Limit::perMinute(100)->by($request->user()?->id ?: $request->ip());
            return response('too many requests.', 429, $headers);
        });
    }
}