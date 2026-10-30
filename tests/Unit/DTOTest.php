<?php

namespace Kaching\BackOffice\Tests\Unit;

use Kaching\BackOffice\DTO\DashboardMetricsDTO;
use Kaching\BackOffice\DTO\InventoryItemDTO;
use Kaching\BackOffice\DTO\MenuDTO;
use PHPUnit\Framework\TestCase as BaseTestCase;

class DTOTest extends BaseTestCase
{
    public function test_menu_dto_serialization(): void
    {
        $dto = MenuDTO::fromArray([
            'id' => 10,
            'name' => 'Ayam Penyet',
            'category' => 'Makanan',
            'price' => 25000,
            'is_available' => true,
            'stock' => 15,
        ]);

        $this->assertEquals(10, $dto->id);
        $this->assertEquals('Ayam Penyet', $dto->name);
        $this->assertEquals(25000, $dto->price);
        $this->assertTrue($dto->isAvailable);

        $array = $dto->toArray();
        $this->assertIsArray($array);
        $this->assertEquals('Ayam Penyet', $array['name']);
    }

    public function test_inventory_dto_low_stock_detection(): void
    {
        $lowStockItem = InventoryItemDTO::fromArray([
            'id' => 1,
            'name' => 'Beras Pandan',
            'sku' => 'RAW-001',
            'current_stock' => 5,
            'minimum_stock' => 10,
        ]);

        $safeStockItem = InventoryItemDTO::fromArray([
            'id' => 2,
            'name' => 'Minyak Goreng',
            'sku' => 'RAW-002',
            'current_stock' => 20,
            'minimum_stock' => 10,
        ]);

        $this->assertTrue($lowStockItem->isLowStock());
        $this->assertFalse($safeStockItem->isLowStock());
    }

    public function test_dashboard_metrics_dto(): void
    {
        $dto = DashboardMetricsDTO::fromArray([
            'total_gross_sales' => 5000000,
            'total_net_sales' => 4500000,
            'total_transactions' => 50,
            'cash_in_hand' => 1500000,
        ]);

        $this->assertEquals(5000000, $dto->totalGrossSales);
        $this->assertEquals(50, $dto->totalTransactions);
        $this->assertEquals(1500000, $dto->cashInHand);
    }
}
