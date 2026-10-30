<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\ReservationServiceInterface;

class MockReservationService implements ReservationServiceInterface
{
    protected array $reservations = [
        [
            'id' => 1,
            'customer_name' => 'Budi Santoso',
            'customer_phone' => '081234567890',
            'pax' => 4,
            'table_number' => 'Meja 01',
            'reservation_time' => '19:00',
            'status' => 'confirmed',
            'notes' => 'Ulang tahun, minta lilin',
        ],
        [
            'id' => 2,
            'customer_name' => 'Siti Rahma',
            'customer_phone' => '089876543210',
            'pax' => 2,
            'table_number' => 'Meja 03',
            'reservation_time' => '20:00',
            'status' => 'pending',
            'notes' => 'Dekat jendela',
        ]
    ];

    public function getUpcomingReservations(string $date, ?int $outletId = null): array
    {
        return $this->reservations;
    }

    public function updateReservationStatus(int $reservationId, string $status): bool
    {
        foreach ($this->reservations as &$res) {
            if ($res['id'] === $reservationId) {
                $res['status'] = $status;
                return true;
            }
        }
        return false;
    }
}
