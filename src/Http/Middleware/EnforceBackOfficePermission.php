<?php

namespace Kaching\BackOffice\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface;
use Symfony\Component\HttpFoundation\Response;

class EnforceBackOfficePermission
{
    public function __construct(
        protected BackOfficeAuthorizationInterface $authorizer
    ) {}

    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $this->authorizer->assertAuthorized($permission);

        return $next($request);
    }
}
