<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\AuthenticatableUserInterface;

class MockUser implements AuthenticatableUserInterface
{
    public function __construct(
        protected int $id = 1,
        protected string $name = 'Dev Owner',
        protected string $email = 'owner@kaching.test',
        protected string $role = 'owner',
        protected bool $isSuperadmin = true,
        protected ?string $avatarUrl = null
    ) {}

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getRole(): string { return $this->role; }
    public function isOwner(): bool { return in_array(strtolower($this->role), ['owner', 'mitra', 'superadmin']); }
    public function isSuperadmin(): bool { return $this->isSuperadmin; }
    public function getAvatarUrl(): ?string { return $this->avatarUrl; }
}
