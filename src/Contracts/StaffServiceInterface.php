<?php

namespace Kaching\BackOffice\Contracts;

use Kaching\BackOffice\DTO\StaffMemberDTO;

interface StaffServiceInterface
{
    /**
     * @return StaffMemberDTO[]
     */
    public function getStaffList(?int $outletId = null): array;

    public function findStaffById(int $id): ?StaffMemberDTO;
}
