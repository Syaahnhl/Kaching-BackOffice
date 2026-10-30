<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\StaffServiceInterface;
use Kaching\BackOffice\DTO\StaffMemberDTO;

class MockStaffService implements StaffServiceInterface
{
    /**
     * @var StaffMemberDTO[]
     */
    protected array $staffList;

    public function __construct()
    {
        $this->staffList = [
            new StaffMemberDTO(1, 1, 1, 'Andi Kasir', 'KASIR', true, 'full_time', false, 6),
            new StaffMemberDTO(2, 1, 1, 'Bambang Chef', 'KITCHEN', true, 'full_time', false, 6),
            new StaffMemberDTO(3, 1, 1, 'Citra Supervisor', 'MANAGER', true, 'full_time', false, 6),
            new StaffMemberDTO(4, 1, 2, 'Dedi Kasir Cabang 2', 'KASIR', true, 'part_time', true, 6),
        ];
    }

    public function getStaffList(?int $outletId = null): array
    {
        if ($outletId) {
            return array_values(array_filter($this->staffList, fn($s) => $s->outletId === $outletId));
        }
        return $this->staffList;
    }

    public function findStaffById(int $id): ?StaffMemberDTO
    {
        foreach ($this->staffList as $s) {
            if ($s->id === $id) {
                return $s;
            }
        }
        return null;
    }
}
