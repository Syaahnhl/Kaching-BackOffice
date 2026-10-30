<?php

namespace Kaching\BackOffice\Contracts;

interface ReservationServiceInterface
{
    public function getUpcomingReservations(string $date, ?int $outletId = null): array;

    public function updateReservationStatus(int $reservationId, string $status): bool;
}
