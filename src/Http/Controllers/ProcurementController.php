<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\ProcurementServiceInterface;

class ProcurementController
{
    public function __construct(
        protected ProcurementServiceInterface $procurementService
    ) {}

    public function index()
    {
        $suppliers = $this->procurementService->getProcurementSuppliers();

        return view('backoffice::procurement', [
            'suppliers' => $suppliers,
        ]);
    }
}
