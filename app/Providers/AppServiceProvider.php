<?php

namespace App\Providers;

use App\Contracts\AccountContract;
use App\Contracts\AuthenticationContract as ContractsAuthenticationContract;
use App\Contracts\DocumentContract;
use App\Contracts\EventContract;
use App\Contracts\NewsContract;
use App\Contracts\PaymentContract;
use App\Contracts\PendudukContract;
use App\Contracts\UserContract;
use App\Http\Controllers\StatisticController;
use App\Services\AccountService;
use App\Services\AuthenticationContract;
use App\Services\AuthenticationService\AuthenticationService as AuthenticationServiceAuthenticationService;
use App\Services\DocumentService;
use App\Services\EventService;
use App\Services\AuthenticationService;
use App\Services\NewsService;
use App\Services\PaymentService;
use App\Services\PendudukService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public array $singletons = [
        UserContract::class => UserService::class,
        AccountContract::class => AccountService::class,
        DocumentContract::class => DocumentService::class,
        EventContract::class => EventService::class,
        NewsContract::class => NewsService::class,
        ContractsAuthenticationContract::class => AuthenticationService::class,
        PaymentContract::class => PaymentService::class,
    ];

    public function provides(): array
    {
        return [
            UserContract::class,
            AccountContract::class,
            DocumentContract::class,
            EventContract::class,
            NewsContract::class,
            ContractsAuthenticationContract::class,
            PaymentContract::class
        ];
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
