<?php

namespace Kaching\BackOffice\Contracts;

interface CurrentOutletResolverInterface
{
    public function getCurrentOutletId(): ?int;
    public function getAccessibleOutlets(): array; // List of DTOs or array [id, name, address]
    public function switchOutlet(int $outletId): bool;
}
