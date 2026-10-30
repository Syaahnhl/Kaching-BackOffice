<?php

namespace Kaching\BackOffice\DTO;

class InventoryItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $sku,
        public readonly string $category,
        public readonly float $currentStock,
        public readonly float $minimumStock,
        public readonly string $baseUom,
        public readonly float $costPrice
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: (string) $data['name'],
            sku: (string) ($data['sku'] ?? ''),
            category: (string) ($data['category'] ?? 'Raw Material'),
            currentStock: (float) ($data['current_stock'] ?? 0),
            minimumStock: (float) ($data['minimum_stock'] ?? 0),
            baseUom: (string) ($data['base_uom'] ?? 'pcs'),
            costPrice: (float) ($data['cost_price'] ?? 0)
        );
    }

    public function isLowStock(): bool
    {
        return $this->currentStock <= $this->minimumStock;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'category' => $this->category,
            'current_stock' => $this->currentStock,
            'minimum_stock' => $this->minimumStock,
            'base_uom' => $this->baseUom,
            'cost_price' => $this->costPrice,
            'is_low_stock' => $this->isLowStock(),
        ];
    }
}
