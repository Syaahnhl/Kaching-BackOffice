<?php

namespace Kaching\BackOffice\Tests\Fixtures;

use Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MockAuthorization implements BackOfficeAuthorizationInterface
{
    /**
     * @var string[]
     */
    protected array $permissions = [
        'manage-menu',
        'view-dashboard',
        'manage-inventory',
        'view-reports',
    ];

    public function canAccess(string $permission): bool
    {
        return in_array($permission, $this->permissions, true);
    }

    public function assertAuthorized(string $permission): void
    {
        if (!$this->canAccess($permission)) {
            throw new HttpException(403, "Access Denied: Missing permission {$permission}");
        }
    }
}
