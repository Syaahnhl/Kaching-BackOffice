<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Http\Request;

$tester = new class('preview') extends \Kaching\BackOffice\Tests\TestCase {
    public function getBuiltApp() {
        $this->setUp();
        return $this->app;
    }
};

$app = $tester->getBuiltApp();

$request = Request::capture();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);
