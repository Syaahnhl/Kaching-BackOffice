<?php

namespace Kaching\BackOffice\Tests\Feature;

use Kaching\BackOffice\Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BackOfficeContractTest extends TestCase
{
    public function test_service_provider_registers_routes(): void
    {
        $response = $this->get(route('backoffice.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Gross Sales');
        $response->assertSee('KACHING');
    }

    public function test_menu_route_renders_synthetic_fixtures(): void
    {
        $response = $this->get(route('backoffice.menus'));
        $response->assertStatus(200);
        $response->assertSee('Nasi Goreng Spesial');
        $response->assertSee('Mie Goreng Jawa');
        $response->assertSee('Es Teh Manis');
    }

    public function test_dashboard_metrics_json_endpoint(): void
    {
        $response = $this->getJson(route('backoffice.dashboard.metrics'));
        $response->assertStatus(200);
        $response->assertJsonPath('status', 'success');
        $response->assertJsonPath('data.total_gross_sales', 14500000);
    }

    public function test_menu_toggle_ajax_endpoint(): void
    {
        $response = $this->postJson(route('backoffice.menus.toggle', ['id' => 1]));
        $response->assertStatus(200);
        $response->assertJsonPath('status', 'success');
    }

    public function test_authorization_deny_by_default(): void
    {
        $authorizer = app(\Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface::class);

        $this->assertTrue($authorizer->canAccess('manage-menu'));
        $this->assertFalse($authorizer->canAccess('unauthorized-superadmin-action'));

        $this->expectException(HttpException::class);
        $authorizer->assertAuthorized('unauthorized-superadmin-action');
    }
}
