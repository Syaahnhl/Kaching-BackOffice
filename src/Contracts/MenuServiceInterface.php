<?php

namespace Kaching\BackOffice\Contracts;

use Kaching\BackOffice\DTO\MenuDTO;

interface MenuServiceInterface
{
    /**
     * @return MenuDTO[]
     */
    public function getMenusForCurrentOutlet(?string $category = null): array;

    public function findMenuById(int $id): ?MenuDTO;

    public function toggleAvailability(int $id): bool;

    public function updateQuickStock(int $id, float $quantity): bool;
}
