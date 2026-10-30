<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\MenuServiceInterface;

class MenuController
{
    public function __construct(
        protected MenuServiceInterface $menuService
    ) {}

    public function index(Request $request)
    {
        $category = $request->input('category');
        $menus = $this->menuService->getMenusForCurrentOutlet($category);

        return view('backoffice::menus', [
            'menus' => $menus,
            'selectedCategory' => $category,
        ]);
    }

    public function toggleAvailable(int $id): JsonResponse
    {
        $success = $this->menuService->toggleAvailability($id);

        return response()->json([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Menu availability toggled' : 'Failed to toggle availability',
        ]);
    }

    public function quickStock(Request $request, int $id): JsonResponse
    {
        $stock = (float) $request->input('stock', 0);
        $success = $this->menuService->updateQuickStock($id, $stock);

        return response()->json([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Stock updated' : 'Failed to update stock',
        ]);
    }
}
