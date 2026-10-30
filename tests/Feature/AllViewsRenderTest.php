<?php

namespace Kaching\BackOffice\Tests\Feature;

use Kaching\BackOffice\Tests\TestCase;

class AllViewsRenderTest extends TestCase
{
    public function test_dashboard_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Performance Dashboard');
        $response->assertSee('Rp 14.500.000');
    }

    public function test_menus_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/menus');
        $response->assertStatus(200);
        $response->assertSee('Katalog Menu');
        $response->assertSee('Ayam Bakar Madu');
    }

    public function test_inventory_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/inventory');
        $response->assertStatus(200);
        $response->assertSee('Inventaris &amp; Bahan Baku', false);
        $response->assertSee('Core FIFO Ledger');
    }

    public function test_reservations_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/reservations');
        $response->assertStatus(200);
        $response->assertSee('Reservasi Meja');
        $response->assertSee('Budi Santoso');
    }

    public function test_procurement_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/procurement');
        $response->assertStatus(200);
        $response->assertSee('Pengadaan &amp; Supplier', false);
        $response->assertSee('PT Sumber Beras Abadi');
    }

    public function test_staff_view_renders_successfully_and_masks_pin(): void
    {
        $response = $this->get('/backoffice/staff');
        $response->assertStatus(200);
        $response->assertSee('Karyawan &amp; Hak Akses', false);
        $response->assertSee('Andi Kasir');
        $response->assertSee('•••••• (Terproteksi)');
        
        // Strict verification: actual PIN numbers or salaries never appear
        $response->assertDontSee('123456');
        $response->assertDontSee('888888');
        $response->assertDontSee('hourly_rate');
        $response->assertDontSee('base_salary');
    }

    public function test_shifts_view_renders_successfully(): void
    {
        $response = $this->get('/backoffice/shifts');
        $response->assertStatus(200);
        $response->assertSee('Riwayat Shift Kasir');
        $response->assertSee('Andi Kasir');
        $response->assertSee('Audit Shift Read-Only');
    }
}
