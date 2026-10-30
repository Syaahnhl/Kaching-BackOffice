<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\ReportingServiceInterface;
use Kaching\BackOffice\DTO\DashboardMetricsDTO;

class MockReportingService implements ReportingServiceInterface
{
    public function getDashboardMetrics(string $startDate, string $endDate, ?int $outletId = null): DashboardMetricsDTO
    {
        return DashboardMetricsDTO::fromArray([
            'total_gross_sales' => 14500000,
            'total_net_sales' => 13200000,
            'total_transactions' => 184,
            'average_basket_size' => 78800,
            'top_selling_items' => [
                ['name' => 'Nasi Goreng Spesial', 'qty' => 45],
                ['name' => 'Es Teh Manis', 'qty' => 98],
            ],
            'cash_in_hand' => 4500000,
            'active_staff_count' => 6,
        ]);
    }

    public function getSalesChartData(string $period = 'daily', ?int $outletId = null): array
    {
        return [
            'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            'data' => [1200000, 1400000, 1100000, 1800000, 2500000, 3400000, 3100000],
        ];
    }
}
