<?php

namespace App\Providers;

use App\Contracts\AccountContract;
use App\Contracts\DocumentContract;
use App\Contracts\EventContract;
use App\Contracts\NewsContract;
use App\Contracts\PendudukContract;
use App\Contracts\UserContract;
use App\Services\AccountService;
use App\Services\AuthenticationContract;
use App\Services\DocumentService;
use App\Services\EventService;
use App\Services\Impl\AuthenticationService;
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
        UserContract::class => UserService::class,
        AccountContract :: class => AccountService::class,
        DocumentContract :: class => DocumentService :: class,
        EventContract :: class => EventService :: class,
        NewsContract :: class => NewsService::class,
        AuthenticationContract :: class => AuthenticationService::class,
    ];

    public function provides():array{
        return [UserContract::class];
        return [AccountContract::class];
        return [DocumentContract::class];
        return [EventContract::class];
        return [NewsContract::class];
        return [AuthenticationContract::class];

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
