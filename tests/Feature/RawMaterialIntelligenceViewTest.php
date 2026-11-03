<?php

namespace Kaching\BackOffice\Tests\Feature;

use Illuminate\Support\ServiceProvider;
use Kaching\BackOffice\BackOfficeServiceProvider;
use Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface;
use Kaching\BackOffice\Contracts\InventoryServiceInterface;
use Kaching\BackOffice\Contracts\MenuServiceInterface;
use Kaching\BackOffice\Contracts\ReportingServiceInterface;
use Kaching\BackOffice\Tests\Fixtures\MockAuthorization;
use Kaching\BackOffice\Tests\TestCase;
use Mockery;

class RawMaterialIntelligenceViewTest extends TestCase
{
    private function allowRmi(): void
    {
        $this->app->instance(BackOfficeAuthorizationInterface::class, new class extends MockAuthorization {
            public function canAccess(string $permission): bool
            {
                return $permission === 'view-raw-material-intelligence' || parent::canAccess($permission);
            }
        });
    }

    public function test_rmi_access_is_denied_without_its_explicit_permission(): void
    {
        $this->get('/backoffice/raw-material-intelligence')->assertForbidden();
    }

    public function test_authorized_page_renders_namespaced_view_and_its_own_assets(): void
    {
        $this->allowRmi();
        $response = $this->get('/backoffice/raw-material-intelligence');
        $response->assertOk()->assertViewIs('backoffice::raw_material_intelligence');
        $response->assertSee('Bahan baku &amp; dampak biaya', false);
        $response->assertSee('Mock Host Session');
        $response->assertSee('vendor/backoffice/rmi/rmi.css');
        $response->assertSee('vendor/backoffice/rmi/rmi-simulator.js');
        $response->assertSee('vendor/backoffice/rmi/rmi-page.js');
        $response->assertSee('Data Simulasi');
        $response->assertSee('AI belum terhubung');
        $this->assertStringEndsWith('/backoffice/raw-material-intelligence', route('backoffice.raw-material-intelligence'));
    }

    public function test_rmi_does_not_change_sidebar_or_header_controls(): void
    {
        $this->allowRmi();
        $dashboard = $this->get('/backoffice/dashboard')->assertOk()->getContent();
        $rmi = $this->get('/backoffice/raw-material-intelligence')->assertOk()->getContent();
        preg_match('/<aside\b[\s\S]*?<\/aside>/', $dashboard, $dashboardSidebar);
        preg_match('/<aside\b[\s\S]*?<\/aside>/', $rmi, $rmiSidebar);
        $this->assertNotEmpty($dashboardSidebar);
        $this->assertSame($dashboardSidebar[0], $rmiSidebar[0]);
        preg_match('/<header\b[\s\S]*?<\/header>/', $dashboard, $dashboardHeader);
        preg_match('/<header\b[\s\S]*?<\/header>/', $rmi, $rmiHeader);
        $normalize = fn ($html) => preg_replace('/(<h1\b[^>]*>)[\s\S]*?(<\/h1>)/', '$1PAGE TITLE$2', $html);
        $this->assertNotEmpty($dashboardHeader);
        $this->assertSame($normalize($dashboardHeader[0]), $normalize($rmiHeader[0]));
    }

    public function test_existing_pages_do_not_load_rmi_assets(): void
    {
        foreach (['dashboard', 'menus', 'inventory', 'reservations', 'procurement', 'staff', 'shifts'] as $page) {
            $this->get('/backoffice/' . $page)->assertOk()->assertDontSee('vendor/backoffice/rmi/');
        }
    }

    public function test_rmi_is_get_only_and_does_not_call_core_data_or_mutation_adapters(): void
    {
        $this->allowRmi();
        foreach ([InventoryServiceInterface::class, MenuServiceInterface::class, ReportingServiceInterface::class] as $contract) {
            $this->app->instance($contract, Mockery::mock($contract));
        }
        $this->get('/backoffice/raw-material-intelligence')->assertOk();
        $this->post('/backoffice/raw-material-intelligence')->assertStatus(405);
        $this->put('/backoffice/raw-material-intelligence')->assertStatus(405);
    }

    public function test_dedicated_asset_publication_copies_the_files_referenced_by_the_page(): void
    {
        $publicPath = dirname(__DIR__, 2) . '/.phpunit.cache/rmi-public';
        $this->app->usePublicPath($publicPath);
        // Re-register after the temporary public path is selected, as a host does on boot.
        ServiceProvider::$publishes = [];
        ServiceProvider::$publishGroups = [];
        (new BackOfficeServiceProvider($this->app))->boot();
        $mapping = ServiceProvider::pathsToPublish(BackOfficeServiceProvider::class, 'kaching-backoffice-rmi-assets');
        $this->assertNotEmpty($mapping);
        $normalizePath = fn ($path) => str_replace('\\', '/', $path);
        $this->assertSame($normalizePath($publicPath . '/vendor/backoffice/rmi'), $normalizePath(array_values($mapping)[0]));
        $this->artisan('vendor:publish', ['--tag' => 'kaching-backoffice-rmi-assets', '--force' => true])->assertSuccessful();
        foreach (['rmi.css', 'rmi-page.js', 'rmi-simulator.js', 'images/rmi-wheat.jpg', 'images/rmi-market.jpg'] as $file) {
            $this->assertFileExists($publicPath . '/vendor/backoffice/rmi/' . $file);
        }
    }
}
