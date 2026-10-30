<?php

namespace Kaching\BackOffice\Contracts;

use Kaching\BackOffice\DTO\InventoryItemDTO;

interface InventoryServiceInterface
{
    /**
     * @return InventoryItemDTO[]
     */
    public function getInventoryItems(?string $search = null, int $perPage = 25): array;

    public function findItemById(int $id): ?InventoryItemDTO;

    public function getLowStockAlerts(): array;
}
