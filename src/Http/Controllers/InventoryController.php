<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\InventoryServiceInterface;

class InventoryController
{
    public function __construct(
        protected InventoryServiceInterface $inventoryService
    ) {}

    public function index(Request $request)
    {
        $search = $request->query('search');
        $items = $this->inventoryService->getInventoryItems($search);
        $lowStock = $this->inventoryService->getLowStockAlerts();

        return view('backoffice::inventory', [
            'items' => $items,
            'lowStock' => $lowStock,
            'search' => $search,
        ]);
    }
}
