<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\ShiftServiceInterface;

class MockShiftService implements ShiftServiceInterface
{
    public function getShiftHistory(?int $outletId = null, int $perPage = 15): array
    {
        return [
            [
                'id' => 101,
                'staff_name' => 'Andi Kasir',
                'start_time' => '2026-10-30 08:00:00',
                'end_time' => '2026-10-30 16:00:00',
                'start_cash' => 200000.0,
                'expected_cash' => 1550000.0,
                'actual_cash' => 1550000.0,
                'difference' => 0.0,
                'status' => 'closed',
            ],
            [
                'id' => 102,
                'staff_name' => 'Citra Supervisor',
                'start_time' => '2026-10-30 16:00:00',
                'end_time' => null,
                'start_cash' => 300000.0,
                'expected_cash' => 850000.0,
                'actual_cash' => null,
                'difference' => null,
                'status' => 'open',
            ],
        ];
    }

    public function getShiftDetail(int $shiftId): ?array
    {
        $shifts = $this->getShiftHistory();
        foreach ($shifts as $s) {
            if ($s['id'] === $shiftId) {
                return $s;
            }
        }
        return null;
    }
}
