<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\ReservationServiceInterface;
use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;

class ReservationController
{
    public function __construct(
        protected ReservationServiceInterface $reservationService,
        protected CurrentOutletResolverInterface $outletResolver
    ) {}

    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        $outletId = $this->outletResolver->getCurrentOutletId();
        $reservations = $this->reservationService->getUpcomingReservations($date, $outletId);

        return view('backoffice::reservations', [
            'reservations' => $reservations,
            'date' => $date,
        ]);
    }
}
