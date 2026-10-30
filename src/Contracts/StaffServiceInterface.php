<?php

namespace Kaching\BackOffice\Contracts;

interface StaffServiceInterface
{
    public function getStaffList(?int $outletId = null): array;

    public function findStaffById(int $id): ?array;
}
