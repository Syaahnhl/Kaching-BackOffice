<?php

namespace Kaching\BackOffice\Contracts;

interface BackOfficeAuthorizationInterface
{
    public function canAccess(string $permission): bool;
    public function assertAuthorized(string $permission): void; // Throws 403 HttpException on failure
}
