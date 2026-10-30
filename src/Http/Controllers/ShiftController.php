<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\ShiftServiceInterface;
use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;

class ShiftController
{
    public function __construct(
        protected ShiftServiceInterface $shiftService,
        protected CurrentOutletResolverInterface $outletResolver
    ) {}

    public function index()
    {
        $outletId = $this->outletResolver->getCurrentOutletId();
        $shifts = $this->shiftService->getShiftHistory($outletId);

        return view('backoffice::shifts', [
            'shifts' => $shifts,
        ]);
    }
}
