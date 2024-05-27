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
use App\Contracts\AdminDocumentContract;
use App\Contracts\AdminPaymentContract;
use App\Contracts\AdminResidentImportContract;
use App\Contracts\DashboardContract;
use App\Contracts\ResidentDocumentContract;
use App\Contracts\ResidentPaymentContract;
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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\AdminDocumentService;
use App\Services\AdminImportService;
use App\Services\AdminPaymentService;
use App\Services\ResidentDocumentService;
use App\Services\ResidentPaymentService;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        AdminDocumentContract::class => AdminDocumentService::class,
        AdminPaymentContract::class => AdminPaymentService::class,
        AdminResidentImportContract::class => AdminImportService::class,
        ResidentDocumentContract::class => ResidentDocumentService::class,
        ResidentPaymentContract::class => ResidentPaymentService::class,
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
            PaymentContract::class,
            AdminDocumentContract::class,
            AdminPaymentContract::class,
            AdminResidentImportContract::class,
            ResidentDocumentContract::class,
            ResidentPaymentContract::class,
            DashboardContract::class
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
        Paginator::defaultView('pagination::default');
    }
}
