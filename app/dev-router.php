<?php
// Local testing only: php -S localhost:8080 app/dev-router.php (run from the site folder).
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = dirname(__DIR__) . $path;
if ($path !== '/' && is_file($file) && !str_ends_with($file, '.php') && !str_starts_with($path, '/app/')) {
    return false;
}
require dirname(__DIR__) . '/index.php';
