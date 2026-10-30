<?php

namespace Kaching\BackOffice\Tests\Feature;

use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;
use Kaching\BackOffice\Tests\TestCase;

class OutletContextAndSecurityTest extends TestCase
{
    public function test_global_outlet_selection_state(): void
    {
        /** @var CurrentOutletResolverInterface $resolver */
        $resolver = app(CurrentOutletResolverInterface::class);

        $this->assertEquals(1, $resolver->getCurrentOutletId());
        $this->assertFalse($resolver->isGlobalOutletSelected());

        $resolver->selectGlobalOutlet();

        $this->assertTrue($resolver->isGlobalOutletSelected());
        $this->assertNull($resolver->getCurrentOutletId());

        $resolver->switchOutlet(2);

        $this->assertFalse($resolver->isGlobalOutletSelected());
        $this->assertEquals(2, $resolver->getCurrentOutletId());
    }

    public function test_staff_pin_is_strictly_masked_and_never_leaked(): void
    {
        $response = $this->get('/backoffice/staff');
        $response->assertStatus(200);

        // Verification of masked state
        $response->assertSee('•••••• (Terproteksi)');

        // Explicit secrets/numbers and salary rates must never be exposed
        $response->assertDontSee('hourly_rate');
        $response->assertDontSee('base_salary');
        $response->assertDontSee('123456');
        $response->assertDontSee('888888');
    }

    public function test_shifts_page_is_strictly_read_only_with_no_mutation_actions(): void
    {
        $response = $this->get('/backoffice/shifts');
        $response->assertStatus(200);

        // UI displays read-only indicator
        $response->assertSee('Audit Shift Read-Only');

        // Form actions or mutation triggers must not exist on shift view
        $response->assertDontSee('action="/shifts/reconcile"');
        $response->assertDontSee('action="/shifts/balance"');
    }
}
