<?php
declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';
require __DIR__ . '/app/contact.php';

send_security_headers();

$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

// Remove a trailing slash (except on "/").
if ($path !== '/' && str_ends_with($path, '/')) {
    $query = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . rtrim($path, '/') . ($query !== '' ? '?' . $query : ''), true, 301);
    exit;
}

if ($path === '/sitemap.xml') {
    render('sitemap');
    exit;
}

$route = resolve_route($path);

if ($route === null) {
    // Guess the language from the first segment so the 404 page is in the right language.
    $first = explode('/', trim($path, '/'))[0] ?? '';
    $LANG = in_array($first, cfg('languages'), true) ? $first : cfg('default_lang');
    $STRINGS = load_strings($LANG);
    http_response_code(404);
    render('layout', ['page' => '404']);
    exit;
}

[$LANG, $page] = $route;
$STRINGS = load_strings($LANG);

$form = ['ok' => isset($_GET['sent']), 'error' => null, 'old' => []];

if ($page === 'contact') {
    csrf_token(); // starts the form's session before any output
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
        $titles = array_column(t('services.items'), 'title');
        $form = handle_contact($titles);
        if ($form['ok']) {
            header('Location: ' . url('contact') . '?sent=1#formulario', true, 303);
            exit;
        }
        http_response_code(422);
    }
    header('Cache-Control: no-store');
} elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET' && ($_SERVER['REQUEST_METHOD'] ?? '') !== 'HEAD') {
    http_response_code(405);
    header('Allow: GET, HEAD');
    exit;
}

render('layout', ['page' => $page, 'form' => $form]);
