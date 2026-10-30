<?php

namespace Kaching\BackOffice\Contracts;

interface ShiftServiceInterface
{
    public function getShiftHistory(?int $outletId = null, int $perPage = 15): array;

    public function getShiftDetail(int $shiftId): ?array;
}
