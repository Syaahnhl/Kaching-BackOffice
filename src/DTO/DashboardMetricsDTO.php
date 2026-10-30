<?php

namespace Kaching\BackOffice\DTO;

class DashboardMetricsDTO
{
    public function __construct(
        public readonly float $totalGrossSales,
        public readonly float $totalNetSales,
        public readonly int $totalTransactions,
        public readonly float $averageBasketSize,
        public readonly array $topSellingItems,
        public readonly float $cashInHand,
        public readonly int $activeStaffCount
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            totalGrossSales: (float) ($data['total_gross_sales'] ?? 0),
            totalNetSales: (float) ($data['total_net_sales'] ?? 0),
            totalTransactions: (int) ($data['total_transactions'] ?? 0),
            averageBasketSize: (float) ($data['average_basket_size'] ?? 0),
            topSellingItems: (array) ($data['top_selling_items'] ?? []),
            cashInHand: (float) ($data['cash_in_hand'] ?? 0),
            activeStaffCount: (int) ($data['active_staff_count'] ?? 0)
        );
    }

    public function toArray(): array
    {
        return [
            'total_gross_sales' => $this->totalGrossSales,
            'total_net_sales' => $this->totalNetSales,
            'total_transactions' => $this->totalTransactions,
            'average_basket_size' => $this->averageBasketSize,
            'top_selling_items' => $this->topSellingItems,
            'cash_in_hand' => $this->cashInHand,
            'active_staff_count' => $this->activeStaffCount,
        ];
    }
}
