<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\News\NewsService;
use App\Services\News\ApiClients\NewsAPIApiClient;
use App\Services\News\ApiClients\TheGuardianApiClient;
use App\Services\News\ApiClients\NYTimesApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('news_api_clients', function ($app) {
            return [
                $app->make(NYTimesApiClient::class, [
                    'config' => config('services.nytimes'),
                ]),
                
                $app->make(TheGuardianApiClient::class, [
                    'config' => config('services.theguardian'),
                ]),
                
                $app->make(NewsAPIApiClient::class, [
                    'config' => config('services.newsapi'),
                ]),
            ];
        });

        $this->app->singleton(NewsService::class, function ($app) {
            return new NewsService($app->make('news_api_clients'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
