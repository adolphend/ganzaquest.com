<?php
declare(strict_types=1);

const AGENT_USE_CASES = ['support', 'knowledge', 'workflows', 'other'];
const AGENT_HOSTING_OPTIONS = ['local', 'local_api', 'api', 'unsure'];

/** Send the details needed for a first project response. */
function handle_agent_request(array $input): array
{
    $field = static fn(string $key): string => is_string($input[$key] ?? null) ? trim($input[$key]) : '';
    $email = $field('email');
    $old = [
        'email' => strlen($email) <= 254 ? $email : '',
        'use_case' => $field('use_case'),
        'sector' => clean_line($field('sector'), 100),
        'hosting' => $field('hosting'),
        'model' => clean_line($field('model'), 120),
        'goal' => clean_text($field('goal'), 600),
    ];
    $error = static fn(string $code): array => ['ok' => false, 'error' => $code, 'old' => $old];

    $token = $input['csrf'] ?? null;
    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        return $error('expired');
    }
    if (!empty($input['website'])) {
        return ['ok' => true, 'error' => null, 'old' => []];
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)
        || !in_array($old['use_case'], AGENT_USE_CASES, true)
        || $old['sector'] === ''
        || !in_array($old['hosting'], AGENT_HOSTING_OPTIONS, true)) {
        return $error('invalid');
    }
    if (rate_limited()) {
        return $error('rate');
    }

    $body = "New request for a custom AI agent.\n"
        . 'Email: ' . $old['email'] . "\n"
        . 'Use case: ' . $old['use_case'] . "\n"
        . 'Sector: ' . $old['sector'] . "\n"
        . 'Deployment: ' . $old['hosting'] . "\n"
        . 'Preferred model or API: ' . ($old['model'] ?: 'Not specified') . "\n"
        . 'Language: ' . $GLOBALS['LANG'] . "\n"
        . 'Goal: ' . ($old['goal'] ?: 'Not specified') . "\n";

    if (!send_site_email('GanzaQuest - Custom AI agent request', $body, $email)) {
        return $error('send');
    }

    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return ['ok' => true, 'error' => null, 'old' => []];
}
