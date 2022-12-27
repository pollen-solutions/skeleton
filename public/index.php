<?php declare(strict_types=1);

use Pollen\Kernel\Http\HttpKernelInterface;
use Pollen\Http\Request;

defined('START_TIME') ?: define('START_TIME', microtime(true));

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var \Pollen\Kernel\ApplicationInterface $app */
$app = require __DIR__.'/../bootstrap/app.php';

if ($kernel = $app->resolve(HttpKernelInterface::class)) {
    $response = $kernel->handle($request = Request::getFromGlobals()->psr());

    $kernel->send($response);
    $kernel->terminate($request, $response);
}