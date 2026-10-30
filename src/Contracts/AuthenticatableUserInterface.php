<?php

namespace Kaching\BackOffice\Contracts;

interface AuthenticatableUserInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getEmail(): string;
    public function getRole(): string; // 'owner' | 'manager' | 'staff'
    public function isSuperadmin(): bool;
    public function getAvatarUrl(): ?string;
}
