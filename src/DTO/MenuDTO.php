<?php

namespace Kaching\BackOffice\DTO;

class MenuDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $category,
        public readonly float $price,
        public readonly bool $isAvailable,
        public readonly float $stock,
        public readonly ?string $imageUrl = null,
        public readonly ?string $description = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: (string) $data['name'],
            category: (string) ($data['category'] ?? 'General'),
            price: (float) $data['price'],
            isAvailable: (bool) ($data['is_available'] ?? true),
            stock: (float) ($data['stock'] ?? 0),
            imageUrl: $data['image_url'] ?? null,
            description: $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'is_available' => $this->isAvailable,
            'stock' => $this->stock,
            'image_url' => $this->imageUrl,
            'description' => $this->description,
        ];
    }
}
