<?php
declare(strict_types=1);

/**
 * Contact form: validation, spam protection and sending by email.
 * Messages are not stored on the server; they are only emailed to cfg('contact_to').
 */

function contact_session(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}

function csrf_token(): string
{
    contact_session();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** Single-line text: trimmed, control characters removed, length capped. */
function clean_line(string $value, int $max): string
{
    $value = trim(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', $value) ?? '');
    return mb_substr($value, 0, $max);
}

function clean_text(string $value, int $max): string
{
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    $value = trim(preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/u', '', $value) ?? '');
    return mb_substr($value, 0, $max);
}

/** At most cfg('contact_rate_limit') submissions per visitor per hour. */
function rate_limited(): bool
{
    $dir = APP_DIR . '/storage/ratelimit';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true)) {
        return false;
    }
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $file = $dir . '/' . hash('sha256', $ip . '|' . __DIR__) . '.json';
    $now = time();
    $hits = is_file($file) ? (json_decode((string) file_get_contents($file), true) ?: []) : [];
    $hits = array_values(array_filter($hits, static fn($ts) => is_int($ts) && $ts > $now - 3600));
    if (count($hits) >= (int) cfg('contact_rate_limit')) {
        return true;
    }
    $hits[] = $now;
    file_put_contents($file, json_encode($hits), LOCK_EX);

    // Occasionally remove old files.
    if (random_int(1, 50) === 1) {
        foreach (glob($dir . '/*.json') ?: [] as $old) {
            if (filemtime($old) < $now - 7200) {
                @unlink($old);
            }
        }
    }
    return false;
}

/**
 * Handle a POSTed contact form.
 * Returns ['ok' => bool, 'error' => string|null, 'old' => array].
 */
function handle_contact(array $serviceTitles): array
{
    contact_session();
    $old = [
        'name' => clean_line((string) ($_POST['name'] ?? ''), 150),
        'email' => clean_line((string) ($_POST['email'] ?? ''), 254),
        'company' => clean_line((string) ($_POST['company'] ?? ''), 200),
        'service' => clean_line((string) ($_POST['service'] ?? ''), 200),
        'message' => clean_text((string) ($_POST['message'] ?? ''), 5000),
    ];

    $token = (string) ($_POST['csrf'] ?? '');
    if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $token)) {
        return ['ok' => false, 'error' => 'expired', 'old' => $old];
    }

    // Honeypot: real visitors never fill this hidden field. Pretend success to bots.
    if (trim((string) ($_POST['website'] ?? '')) !== '') {
        return ['ok' => true, 'error' => null, 'old' => []];
    }

    if (
        $old['name'] === ''
        || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)
        || mb_strlen($old['message']) < 10
        || ($_POST['consent'] ?? '') !== 'true'
    ) {
        return ['ok' => false, 'error' => 'invalid', 'old' => $old];
    }

    if (rate_limited()) {
        return ['ok' => false, 'error' => 'rate', 'old' => $old];
    }

    $service = in_array($old['service'], $serviceTitles, true) ? $old['service'] : 'General';
    $body = "New message from the GanzaQuest website\n"
        . "----------------------------------------\n"
        . 'Name: ' . $old['name'] . "\n"
        . 'Email: ' . $old['email'] . "\n"
        . 'Company: ' . ($old['company'] !== '' ? $old['company'] : '-') . "\n"
        . 'Interest: ' . $service . "\n"
        . 'Language: ' . ($GLOBALS['LANG'] ?? '') . "\n"
        . 'Date: ' . gmdate('Y-m-d H:i') . " UTC\n\n"
        . $old['message'] . "\n";

    if (!send_site_email('GanzaQuest – ' . $old['name'], $body, $old['email'])) {
        return ['ok' => false, 'error' => 'send', 'old' => $old];
    }

    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return ['ok' => true, 'error' => null, 'old' => []];
}

/** Send a notification to the site's configured recipient. */
function send_site_email(string $subject, string $body, string $replyTo): bool
{
    $to = (string) cfg('contact_to');
    $from = (string) cfg('contact_from');
    if (!filter_var($to, FILTER_VALIDATE_EMAIL) || str_starts_with($to, 'CHANGE-ME')
        || !filter_var($from, FILTER_VALIDATE_EMAIL) || !filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        error_log('Website mail: configure valid contact_to and contact_from addresses');
        return false;
    }

    $encodedSubject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n");
    $headers = implode("\r\n", [
        'From: GanzaQuest website <' . $from . '>',
        'Reply-To: ' . $replyTo,
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ]);

    $sent = @mail($to, $encodedSubject, $body, $headers, '-f' . $from);
    if (!$sent) {
        error_log('Website mail: mail() failed');
    }
    return $sent;
}
