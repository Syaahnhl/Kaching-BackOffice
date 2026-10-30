<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\InventoryServiceInterface;
use Kaching\BackOffice\Database\Seeders\SyntheticDataFixtures;
use Kaching\BackOffice\DTO\InventoryItemDTO;

class MockInventoryService implements InventoryServiceInterface
{
    /**
     * @var InventoryItemDTO[]
     */
    protected array $items;

    public function __construct()
    {
        $this->items = SyntheticDataFixtures::getInventoryItems();
    }

    public function getInventoryItems(?string $search = null, int $perPage = 25): array
    {
        if ($search) {
            return array_values(array_filter($this->items, fn($item) => stripos($item->name, $search) !== false));
        }
        return $this->items;
    }

    public function findItemById(int $id): ?InventoryItemDTO
    {
        foreach ($this->items as $item) {
            if ($item->id === $id) {
                return $item;
            }
        }
        return null;
    }

    public function getLowStockAlerts(): array
    {
        return array_values(array_filter($this->items, fn($item) => $item->currentStock <= $item->minimumStock));
    }
}
