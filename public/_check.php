<?php

/**
 * Temporary deploy diagnostic — DELETE this file after fixing.
 * Open: https://vago.websitehoinghi.com/_check.php
 */

header('Content-Type: text/plain; charset=utf-8');

$root = dirname(__DIR__);
$lines = [];
$ok = static function (string $label, bool $pass, string $detail = '') use (&$lines): void {
    $lines[] = ($pass ? '[OK]  ' : '[FAIL] ').$label.($detail !== '' ? ' — '.$detail : '');
};

$lines[] = 'VAGO deploy check — '.date('c');
$lines[] = str_repeat('-', 60);

$ok('PHP version >= 8.3', version_compare(PHP_VERSION, '8.3.0', '>='), PHP_VERSION);
$ok('vendor/autoload.php', file_exists($root.'/vendor/autoload.php'));
$ok('.env exists', file_exists($root.'/.env'));
$ok('storage writable', is_writable($root.'/storage'), $root.'/storage');
$ok('storage/logs writable', is_dir($root.'/storage/logs') && is_writable($root.'/storage/logs'));
$ok('bootstrap/cache writable', is_writable($root.'/bootstrap/cache'));
$ok('public/storage link', is_link($root.'/public/storage') || is_dir($root.'/public/storage'));

$exts = ['mbstring', 'openssl', 'pdo', 'tokenizer', 'xml', 'ctype', 'json', 'fileinfo', 'bcmath', 'gd'];
foreach ($exts as $ext) {
    $ok('ext '.$ext, extension_loaded($ext));
}

$lines[] = str_repeat('-', 60);

if (! file_exists($root.'/vendor/autoload.php')) {
    $lines[] = 'STOP: chạy `composer install --no-dev` trên server.';
    echo implode("\n", $lines);
    exit;
}

try {
    require $root.'/vendor/autoload.php';
    $app = require $root.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    $ok('Laravel bootstrap', true, $app->version());
    $ok('APP_KEY set', filled(config('app.key')));
    $ok('APP_DEBUG', true, config('app.debug') ? 'true' : 'false');
    $ok('APP_URL', true, (string) config('app.url'));
    $ok('DB connection', true, (string) config('database.default'));

    try {
        Illuminate\Support\Facades\DB::connection()->getPdo();
        $ok('DB connect', true);
        $tables = ['users', 'sessions', 'cache', 'settings', 'posts'];
        foreach ($tables as $table) {
            $ok('table '.$table, Illuminate\Support\Facades\Schema::hasTable($table));
        }
    } catch (Throwable $e) {
        $ok('DB connect', false, $e->getMessage());
    }
} catch (Throwable $e) {
    $lines[] = '[FAIL] Laravel bootstrap — '.$e->getMessage();
    $lines[] = $e->getFile().':'.$e->getLine();
    $lines[] = $e->getTraceAsString();
}

$out = implode("\n", $lines)."\n";
echo $out;

$logDir = $root.'/storage/logs';
if (is_dir($logDir) && is_writable($logDir)) {
    file_put_contents($logDir.'/deploy-check.log', $out);
}
