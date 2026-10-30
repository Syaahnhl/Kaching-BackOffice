<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\StaffServiceInterface;
use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;

class StaffController
{
    public function __construct(
        protected StaffServiceInterface $staffService,
        protected CurrentOutletResolverInterface $outletResolver
    ) {}

    public function index()
    {
        $outletId = $this->outletResolver->getCurrentOutletId();
        $staffMembers = $this->staffService->getStaffList($outletId);

        return view('backoffice::staff', [
            'staffMembers' => $staffMembers,
        ]);
    }
}
