<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Contracts\View\View;

/** Presentation-only RMI workspace. No Core data or mutation adapters are called. */
class RawMaterialIntelligenceController
{
    public function index(): View
    {
        return view('backoffice::raw_material_intelligence');
    }
}
