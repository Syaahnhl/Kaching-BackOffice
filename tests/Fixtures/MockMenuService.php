<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\MenuServiceInterface;
use Kaching\BackOffice\Database\Seeders\SyntheticDataFixtures;
use Kaching\BackOffice\DTO\MenuDTO;

class MockMenuService implements MenuServiceInterface
{
    /**
     * @var MenuDTO[]
     */
    protected array $menus;

    public function __construct()
    {
        $this->menus = SyntheticDataFixtures::getMenus();
    }

    public function getMenusForCurrentOutlet(?string $category = null): array
    {
        if ($category) {
            return array_values(array_filter($this->menus, fn($m) => $m->category === $category));
        }
        return $this->menus;
    }

    public function findMenuById(int $id): ?MenuDTO
    {
        foreach ($this->menus as $menu) {
            if ($menu->id === $id) {
                return $menu;
            }
        }
        return null;
    }

    public function toggleAvailability(int $id): bool
    {
        return true;
    }

    public function updateQuickStock(int $id, float $quantity): bool
    {
        return true;
    }
}
