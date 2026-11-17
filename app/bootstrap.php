<?php
declare(strict_types=1);

// Never show PHP errors to visitors; log them privately instead.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/storage/error.log');
ini_set('expose_php', '0');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');
session_name('gq_s');

const APP_DIR = __DIR__;

$CONFIG = require APP_DIR . '/config.php';
$LANG = $CONFIG['default_lang'];
$STRINGS = [];

function cfg(string $key)
{
    global $CONFIG;
    return $CONFIG[$key] ?? null;
}

/** Escape text for HTML output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function load_strings(string $lang): array
{
    static $cache = [];
    if (!isset($cache[$lang])) {
        $file = APP_DIR . '/lang/' . $lang . '.php';
        $cache[$lang] = is_file($file) ? require $file : [];
    }
    return $cache[$lang];
}

/** Translated value by dot path, e.g. t('hero.title'). Arrays are returned as-is. */
function t(string $path)
{
    global $STRINGS;
    $value = $STRINGS;
    foreach (explode('.', $path) as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return $path;
        }
        $value = $value[$part];
    }
    return $value;
}

/** Translated, escaped text. */
function te(string $path): string
{
    $value = t($path);
    return is_string($value) ? e($value) : '';
}

/** Translated text where "\n" becomes a line break. */
function tbr(string $path): string
{
    return nl2br(te($path), false);
}

/** Path of a page in a language, e.g. url('about', 'en') → /en/about */
function url(string $page, ?string $lang = null): string
{
    global $LANG;
    $lang = $lang ?? $LANG;
    $slug = cfg('slugs')[$lang][$page] ?? '';
    $prefix = $lang === cfg('default_lang') ? '' : '/' . $lang;
    $path = $prefix . ($slug === '' ? '' : '/' . $slug);
    return $path === '' ? '/' : $path;
}

function absolute_url(string $path): string
{
    return rtrim(cfg('site_url'), '/') . $path;
}

function asset(string $path): string
{
    $file = dirname(APP_DIR) . '/assets/' . $path;
    $version = is_file($file) ? (string) filemtime($file) : '1';
    return '/assets/' . $path . '?v=' . $version;
}

/** Resolve a request path to [lang, page] or null when no page matches. */
function resolve_route(string $path): ?array
{
    $segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
    $lang = cfg('default_lang');
    if ($segments && in_array($segments[0], cfg('languages'), true) && $segments[0] !== cfg('default_lang')) {
        $lang = array_shift($segments);
    }
    if (count($segments) > 1) {
        return null;
    }
    $slug = $segments[0] ?? '';
    $page = array_search($slug, cfg('slugs')[$lang], true);
    return $page === false ? null : [$lang, $page];
}

/** Inline SVG icon (from the Lucide icon set). */
function icon(string $name, int $size = 18, float $stroke = 2): string
{
    static $paths = [
        'arrow-up-right' => '<path d="M7 7h10v10"/><path d="M7 17 17 7"/>',
        'arrow-down' => '<path d="M12 5v14"/><path d="m19 12-7 7-7-7"/>',
        'sparkles' => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>',
        'smartphone' => '<rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>',
        'workflow' => '<rect width="8" height="8" x="3" y="3" rx="2"/><path d="M7 11v4a2 2 0 0 0 2 2h4"/><rect width="8" height="8" x="13" y="13" rx="2"/>',
        'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
        'code' => '<path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/>',
        'book-open' => '<path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/>',
        'layers' => '<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
        'lock' => '<circle cx="12" cy="16" r="1"/><rect x="3" y="10" width="18" height="12" rx="2"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/>',
        'check-circle' => '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
        'menu' => '<line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>',
        'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'globe' => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
        'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
        'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
    ];
    return '<svg class="icon" xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . $stroke
        . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . ($paths[$name] ?? '') . '</svg>';
}

/**
 * NCIATA logo mark: a sun rising inside a shield (Annonciate = good news, Mugema = protection).
 * Lines use the current text colour; the sun uses $sun.
 */
function nciata_mark(int $height, string $sun = 'currentColor', string $class = 'nciata-mark'): string
{
    $width = (int) round($height * 100 / 110);
    return '<svg class="' . e($class) . '" xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height
        . '" viewBox="0 0 100 110" aria-hidden="true" focusable="false">'
        . '<g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">'
        . '<path d="M50 5 L89 19 V52 C89 77 72 95 50 105 C28 95 11 77 11 52 V19 Z" stroke-width="6"/>'
        . '<g stroke-width="5"><line x1="50" y1="38" x2="50" y2="29"/><line x1="64" y1="42" x2="69" y2="34"/>'
        . '<line x1="36" y1="42" x2="31" y2="34"/><line x1="73.5" y1="52" x2="81" y2="47.5"/><line x1="26.5" y1="52" x2="19" y2="47.5"/></g>'
        . '<line x1="22" y1="64" x2="78" y2="64" stroke-width="5"/><line x1="33" y1="75" x2="67" y2="75" stroke-width="5"/>'
        . '<line x1="43" y1="86" x2="57" y2="86" stroke-width="5"/></g>'
        . '<path d="M31 64 A19 19 0 0 1 69 64 Z" fill="' . e($sun) . '"/></svg>';
}

/** Large etched version of the NCIATA mark, with hatched sun, for hero and feature images. */
function nciata_illustration(int $height, string $label = ''): string
{
    $width = (int) round($height * 100 / 110);
    $rays = '';
    foreach ([-180, -150, -120, -90, -60, -30, 0] as $angle) {
        $r = deg2rad($angle);
        $rays .= sprintf('<line x1="%.1f" y1="%.1f" x2="%.1f" y2="%.1f"/>', 50 + 25 * cos($r), 62 + 25 * sin($r), 50 + 33 * cos($r), 62 + 33 * sin($r));
    }
    $hatch = '';
    for ($y = 44.5; $y <= 61; $y += 2.6) {
        $hatch .= sprintf('<line x1="28" y1="%.1f" x2="72" y2="%.1f"/>', $y, $y);
    }
    $id = 'sun' . substr(md5((string) $height . $label), 0, 6);
    $a11y = $label !== '' ? 'role="img" aria-label="' . e($label) . '"' : 'aria-hidden="true" focusable="false"';
    return '<svg class="nciata-illustration" xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height
        . '" viewBox="0 0 100 110" ' . $a11y . '>'
        . '<defs><clipPath id="' . $id . '"><path d="M30 62 A20 20 0 0 1 70 62 Z"/></clipPath></defs>'
        . '<g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">'
        . '<path d="M50 4 L90 18 V52 C90 78 72 96 50 106 C28 96 10 78 10 52 V18 Z" stroke-width="1.6"/>'
        . '<path d="M50 9.5 L85 22 V52 C85 74.5 69.5 90.5 50 100 C30.5 90.5 15 74.5 15 52 V22 Z" stroke-width=".6" opacity=".55"/>'
        . '<path d="M30 62 A20 20 0 0 1 70 62" stroke-width="1.4"/>'
        . '<g stroke-width="1.2">' . $rays . '</g>'
        . '<line x1="20" y1="62" x2="80" y2="62" stroke-width="1.4"/>'
        . '<g stroke-width="1"><line x1="29" y1="70" x2="71" y2="70"/><line x1="37" y1="78" x2="63" y2="78"/><line x1="44" y1="86" x2="56" y2="86"/></g></g>'
        . '<g clip-path="url(#' . $id . ')" stroke="#e8a317" stroke-width=".9">' . $hatch . '</g></svg>';
}

function send_security_headers(): void
{
    header_remove('X-Powered-By');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; img-src 'self' data:; form-action 'self'; frame-ancestors 'self'; base-uri 'self'; object-src 'none'");
}

function render(string $view, array $data = []): void
{
    $LANG = $GLOBALS['LANG'];
    extract($data, EXTR_SKIP);
    require APP_DIR . '/views/' . $view . '.php';
}
