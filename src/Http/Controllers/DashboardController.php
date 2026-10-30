<?php

namespace Kaching\BackOffice\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\AuthenticatableUserInterface;
use Kaching\BackOffice\Contracts\CurrentOutletResolverInterface;
use Kaching\BackOffice\Contracts\ReportingServiceInterface;

class DashboardController
{
    public function __construct(
        protected ReportingServiceInterface $reportingService,
        protected CurrentOutletResolverInterface $outletResolver,
        protected AuthenticatableUserInterface $currentUser
    ) {}

    public function index(Request $request)
    {
        $outletId = $this->outletResolver->getCurrentOutletId();
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $metrics = $this->reportingService->getDashboardMetrics($startDate, $endDate, $outletId);
        $chartData = $this->reportingService->getSalesChartData('daily', $outletId);
        $outlets = $this->outletResolver->getAccessibleOutlets();

        return view('backoffice::dashboard', [
            'metrics' => $metrics,
            'chartData' => $chartData,
            'outlets' => $outlets,
            'currentOutletId' => $outletId,
            'user' => $this->currentUser,
        ]);
    }

    public function getMetricsJson(Request $request): JsonResponse
    {
        $outletId = $this->outletResolver->getCurrentOutletId();
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $metrics = $this->reportingService->getDashboardMetrics($startDate, $endDate, $outletId);

        return response()->json([
            'status' => 'success',
            'data' => $metrics->toArray(),
        ]);
    }
}
