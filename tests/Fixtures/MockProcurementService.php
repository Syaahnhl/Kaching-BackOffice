<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\ProcurementServiceInterface;

class MockProcurementService implements ProcurementServiceInterface
{
    public function getProcurementSuppliers(): array
    {
        return [
            ['id' => 1, 'name' => 'PT Sumber Beras Abadi', 'phone' => '08111222333', 'items_count' => 5],
            ['id' => 2, 'name' => 'CV Sayur Segar Lembang', 'phone' => '08122334455', 'items_count' => 12],
            ['id' => 3, 'name' => 'Toko Daging Barokah', 'phone' => '08133445566', 'items_count' => 4],
        ];
    }

    public function generateRestockWhatsAppDraft(int $supplierId, array $itemQuantities): string
    {
        $lines = ["Halo, kami dari Kaching Resto ingin memesan bahan baku berikut:"];
        foreach ($itemQuantities as $item => $qty) {
            $lines[] = "- {$item}: {$qty}";
        }
        $lines[] = "Mohon konfirmasi ketersediaan dan total harga. Terima kasih.";
        return implode("\n", $lines);
    }
}
