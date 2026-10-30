<?php

namespace Kaching\BackOffice;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Kaching\BackOffice\Http\Controllers\DashboardController;
use Kaching\BackOffice\Http\Controllers\MenuController;
use Kaching\BackOffice\Http\Controllers\InventoryController;
use Kaching\BackOffice\Http\Controllers\ReservationController;
use Kaching\BackOffice\Http\Controllers\ProcurementController;
use Kaching\BackOffice\Http\Controllers\StaffController;
use Kaching\BackOffice\Http\Controllers\ShiftController;
use Kaching\BackOffice\Http\Middleware\EnforceBackOfficePermission;

class BackOfficeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/backoffice.php', 'backoffice');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/backoffice', 'backoffice');

        $this->publishes([
            __DIR__ . '/../config/backoffice.php' => config_path('backoffice.php'),
        ], 'kaching-backoffice-config');

        $this->publishes([
            __DIR__ . '/../resources/views/backoffice' => resource_path('views/vendor/backoffice'),
        ], 'kaching-backoffice-views');

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path('vendor/backoffice/css'),
            __DIR__ . '/../resources/js' => public_path('vendor/backoffice/js'),
        ], 'kaching-backoffice-assets');

        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        Route::middleware(['web'])
            ->prefix(config('backoffice.route_prefix', 'backoffice'))
            ->as('backoffice.')
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/dashboard/metrics', [DashboardController::class, 'getMetricsJson'])->name('dashboard.metrics');

                Route::get('/menus', [MenuController::class, 'index'])->name('menus');
                Route::post('/menus/{id}/toggle-available', [MenuController::class, 'toggleAvailable'])->name('menus.toggle');
                Route::post('/menus/{id}/quick-stock', [MenuController::class, 'quickStock'])->name('menus.quick-stock');

                Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
                Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
                Route::get('/procurement', [ProcurementController::class, 'index'])->name('procurement');
                Route::get('/staff', [StaffController::class, 'index'])->name('staff');
                Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts');
            });
    }
}
