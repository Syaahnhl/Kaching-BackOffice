<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;

class MockOutletResolver implements CurrentOutletResolverInterface
{
    protected ?int $currentOutletId = 1;
    protected bool $isGlobal = false;

    public function getCurrentOutletId(): ?int
    {
        return $this->isGlobal ? null : $this->currentOutletId;
    }

    public function isGlobalOutletSelected(): bool
    {
        return $this->isGlobal;
    }

    public function selectGlobalOutlet(): bool
    {
        $this->isGlobal = true;
        $this->currentOutletId = null;
        return true;
    }

    public function getAccessibleOutlets(): array
    {
        return [
            ['id' => 1, 'name' => 'Outlet Pusat - Kaching Menteng', 'address' => 'Jl. Menteng No. 10'],
            ['id' => 2, 'name' => 'Outlet Cabang - Kaching Senopati', 'address' => 'Jl. Senopati No. 45'],
        ];
    }

    public function switchOutlet(int $outletId): bool
    {
        $this->isGlobal = false;
        $this->currentOutletId = $outletId;
        return true;
    }
}
