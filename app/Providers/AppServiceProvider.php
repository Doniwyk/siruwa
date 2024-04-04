<?php

namespace App\Providers;

use App\Contracts\NewsContract;
use App\Contracts\PendudukContract;
use App\Contracts\UserContract;
use App\Services\NewsService;
use App\Services\PendudukService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public array $singletons =[
        UserContract::class => UserService::class    
    ];

    public function provides():array{
        return [UserContract::class];
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
