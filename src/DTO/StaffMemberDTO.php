<?php

namespace Kaching\BackOffice\DTO;

class StaffMemberDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly int $outletId,
        public readonly string $staffName,
        public readonly string $role,
        public readonly bool $isActive,
        public readonly string $employmentType = 'full_time',
        public readonly bool $mustChangePin = false,
        public readonly int $pinLength = 6
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'outlet_id' => $this->outletId,
            'staff_name' => $this->staffName,
            'role' => $this->role,
            'is_active' => $this->isActive,
            'employment_type' => $this->employmentType,
            'must_change_pin' => $this->mustChangePin,
            'pin_length' => $this->pinLength,
        ];
    }
}
