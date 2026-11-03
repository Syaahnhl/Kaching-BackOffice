<?php

// Development fixture host only. Not a production entry point or authorization adapter.
if (PHP_SAPI !== 'cli-server' || !in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true)) {
    http_response_code(404);
    exit;
}
if (!in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) {
    http_response_code(405);
    exit;
}

$packageRoot = dirname(__DIR__);
$requestPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$assetPrefix = '/vendor/backoffice/rmi/';
if (str_starts_with($requestPath, $assetPrefix)) {
    $relativeAsset = substr($requestPath, strlen($assetPrefix));
    $allowedAssets = [
        'rmi.css' => 'text/css',
        'rmi-page.js' => 'text/javascript',
        'rmi-simulator.js' => 'text/javascript',
        'images/rmi-wheat.jpg' => 'image/jpeg',
        'images/rmi-market.jpg' => 'image/jpeg',
    ];
    if (!isset($allowedAssets[$relativeAsset])) { http_response_code(404); exit; }
    header('Content-Type: ' . $allowedAssets[$relativeAsset]);
    header('X-Content-Type-Options: nosniff');
    readfile($packageRoot . '/resources/rmi/' . $relativeAsset);
    exit;
}
if ($requestPath === '/favicon.ico') { http_response_code(204); exit; }

if (!class_exists(\Kaching\BackOffice\Tests\TestCase::class)) {
    require $packageRoot . '/vendor/autoload.php';
}

$tester = new class('rmi-preview') extends \Kaching\BackOffice\Tests\TestCase {
    public function getBuiltApp()
    {
        $this->setUp();
        // Grant only in this loopback-only synthetic preview. Host authorization is unchanged.
        $this->app->instance(\Kaching\BackOffice\Contracts\BackOfficeAuthorizationInterface::class,
            new class extends \Kaching\BackOffice\Tests\Fixtures\MockAuthorization {
                public function canAccess(string $permission): bool
                {
                    return $permission === 'view-raw-material-intelligence' || parent::canAccess($permission);
                }
            });
        return $this->app;
    }
};

$app = $tester->getBuiltApp();
$request = \Illuminate\Http\Request::capture();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);
