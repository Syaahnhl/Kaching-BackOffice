<?php

namespace Kaching\BackOffice\Tests;

use Kaching\BackOffice\BackOfficeServiceProvider;
use Kaching\BackOffice\Contracts\AuthenticatableUserInterface;
use Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface;
use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;
use Kaching\BackOffice\Contracts\MenuServiceInterface;
use Kaching\BackOffice\Contracts\ReportingServiceInterface;
use Kaching\BackOffice\Contracts\InventoryServiceInterface;
use Kaching\BackOffice\Contracts\ReservationServiceInterface;
use Kaching\BackOffice\Contracts\ProcurementServiceInterface;
use Kaching\BackOffice\Contracts\StaffServiceInterface;
use Kaching\BackOffice\Contracts\ShiftServiceInterface;
use Kaching\BackOffice\Tests\Fixtures\MockAuthorization;
use Kaching\BackOffice\Tests\Fixtures\MockMenuService;
use Kaching\BackOffice\Tests\Fixtures\MockOutletResolver;
use Kaching\BackOffice\Tests\Fixtures\MockReportingService;
use Kaching\BackOffice\Tests\Fixtures\MockUser;
use Kaching\BackOffice\Tests\Fixtures\MockInventoryService;
use Kaching\BackOffice\Tests\Fixtures\MockReservationService;
use Kaching\BackOffice\Tests\Fixtures\MockProcurementService;
use Kaching\BackOffice\Tests\Fixtures\MockStaffService;
use Kaching\BackOffice\Tests\Fixtures\MockShiftService;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BackOfficeServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:yk4W4d3Fv+A9f8sD3vD3f8sD3vD3f8sD3vD3f8sD3vE=');
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Bind mock contracts
        $app->singleton(AuthenticatableUserInterface::class, fn() => new MockUser());
        $app->singleton(CurrentOutletResolverInterface::class, fn() => new MockOutletResolver());
        $app->singleton(BackOfficeAuthorizationInterface::class, fn() => new MockAuthorization());
        $app->singleton(MenuServiceInterface::class, fn() => new MockMenuService());
        $app->singleton(ReportingServiceInterface::class, fn() => new MockReportingService());
        $app->singleton(InventoryServiceInterface::class, fn() => new MockInventoryService());
        $app->singleton(ReservationServiceInterface::class, fn() => new MockReservationService());
        $app->singleton(ProcurementServiceInterface::class, fn() => new MockProcurementService());
        $app->singleton(StaffServiceInterface::class, fn() => new MockStaffService());
        $app->singleton(ShiftServiceInterface::class, fn() => new MockShiftService());
    }
}
