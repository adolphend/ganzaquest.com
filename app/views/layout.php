<?php
/** @var string $page */
$form = $form ?? ['ok' => false, 'error' => null, 'old' => []];
$isHome = $page === 'home';
$is404 = $page === '404';

if ($isHome) {
    $title = t('meta.home_title');
    $description = t('meta.home_description');
} elseif ($is404) {
    $title = t('meta.not_found_title');
    $description = t('meta.not_found_description');
} else {
    $title = t('nav.' . $page) . ' | GanzaQuest';
    $description = t('pages.' . $page . '.description');
}
$canonical = $is404 ? null : absolute_url(url($page));
?>
<!doctype html>
<html lang="<?= e($LANG) ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>">
<?php if ($is404): ?>
<meta name="robots" content="noindex">
<?php else: ?>
<link rel="canonical" href="<?= e($canonical) ?>">
<?php foreach (cfg('languages') as $code): ?>
<link rel="alternate" hreflang="<?= e($code) ?>" href="<?= e(absolute_url(url($page, $code))) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= e(absolute_url(url($page, cfg('default_lang')))) ?>">
<?php endif; ?>
<meta property="og:type" content="website">
<meta property="og:site_name" content="GanzaQuest">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($description) ?>">
<meta property="og:image" content="<?= e(cfg('social_image')) ?>">
<meta property="og:locale" content="<?= te('locale') ?>">
<?php if ($canonical): ?>
<meta property="og:url" content="<?= e($canonical) ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="<?= e(asset('img/nciata-mark.svg')) ?>" type="image/svg+xml">
<link rel="icon" href="<?= e(asset('img/favicon.png')) ?>" type="image/png">
<link rel="apple-touch-icon" href="<?= e(asset('img/favicon.png')) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap">
<link rel="stylesheet" href="<?= e(asset('css/site.css')) ?>">
<?php if ($isHome): ?>
<script type="application/ld+json"><?= json_encode([
    ['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => 'GanzaQuest', 'url' => cfg('site_url') . '/', 'inLanguage' => $LANG],
    ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'GanzaQuest', 'legalName' => 'NCIATA Ltd', 'url' => cfg('site_url') . '/', 'logo' => cfg('site_url') . '/assets/img/favicon.png'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
<?php endif; ?>
<script src="<?= e(asset('js/site.js')) ?>" defer></script>
</head>
<body>
<a class="skip-link" href="#contenido"><?= te('a11y.skip') ?></a>
<?php render('partials/header', ['page' => $page]); ?>
<main id="contenido">
<?php
if ($isHome) {
    render('pages/home');
} elseif ($is404) {
    render('partials/intro', ['label' => t('not_found.label'), 'title' => t('not_found.title'), 'intro' => t('not_found.intro')]);
    render('pages/404');
} else {
    render('partials/intro', ['label' => t("pages.$page.label"), 'title' => t("pages.$page.title"), 'intro' => t("pages.$page.intro")]);
    render('pages/' . $page, ['form' => $form]);
    if (!in_array($page, ['contact', 'privacy'], true)) {
        render('partials/cta');
    }
}
?>
</main>
<?php render('partials/footer'); ?>
</body>
</html>
