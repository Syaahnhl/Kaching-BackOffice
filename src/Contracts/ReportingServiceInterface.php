<?php

namespace Kaching\BackOffice\Contracts;

use Kaching\BackOffice\DTO\DashboardMetricsDTO;

interface ReportingServiceInterface
{
    public function getDashboardMetrics(string $startDate, string $endDate, ?int $outletId = null): DashboardMetricsDTO;

    public function getSalesChartData(string $period = 'daily', ?int $outletId = null): array;
}
