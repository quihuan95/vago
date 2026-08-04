<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Use app storage for PHP temp files (avoids tempnam() warning on hosting).
$tmpDir = __DIR__.'/../storage/framework/tmp';
if (! is_dir($tmpDir)) {
    @mkdir($tmpDir, 0775, true);
}
if (is_dir($tmpDir) && is_writable($tmpDir)) {
    putenv('TMPDIR='.$tmpDir);
    putenv('TMP='.$tmpDir);
    putenv('TEMP='.$tmpDir);
    ini_set('upload_tmp_dir', $tmpDir);
    ini_set('sys_temp_dir', $tmpDir);
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
if (! file_exists(__DIR__.'/../vendor/autoload.php')) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Missing vendor/. Run: composer install --no-dev --optimize-autoloader\n";
    exit(1);
}

require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
