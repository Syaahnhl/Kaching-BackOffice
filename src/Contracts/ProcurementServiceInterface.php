<?php

namespace Kaching\BackOffice\Contracts;

interface ProcurementServiceInterface
{
    public function getProcurementSuppliers(): array;

    public function generateRestockWhatsAppDraft(int $supplierId, array $itemQuantities): string;
}
