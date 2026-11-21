<?php
declare(strict_types=1);

/** Validate a course signup and email it to the site team. */
function handle_course_interest(array $input): array
{
    $email = is_string($input['email'] ?? null) ? trim($input['email']) : '';
    $old = ['email' => strlen($email) <= 254 ? $email : ''];
    $token = $input['csrf'] ?? null;

    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        return ['ok' => false, 'error' => 'expired', 'old' => $old];
    }

    if (!empty($input['website'])) {
        return ['ok' => true, 'error' => null, 'old' => []];
    }

    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'error' => 'email', 'old' => $old];
    }

    if (rate_limited()) {
        return ['ok' => false, 'error' => 'rate', 'old' => $old];
    }

    $body = "New interest in the Cybersecurity Awareness Basics course.\n"
        . 'Email: ' . $email . "\n"
        . 'Language: ' . $GLOBALS['LANG'] . "\n";

    if (!send_site_email('GanzaQuest - Cybersecurity course interest', $body, $email)) {
        return ['ok' => false, 'error' => 'send', 'old' => $old];
    }

    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return ['ok' => true, 'error' => null, 'old' => []];
}
