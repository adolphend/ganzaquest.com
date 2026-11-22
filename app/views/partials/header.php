<?php
/** @var string $page */
$switchPage = $page === '404' ? 'home' : $page;
$langSwitch = static function (string $class) use ($switchPage, $LANG): void { ?>
<div class="<?= e($class) ?>" role="group" aria-label="<?= te('a11y.language') ?>">
<?php foreach (cfg('languages') as $code):
    if (!isset(cfg('slugs')[$code][$switchPage])) continue;
    $name = load_strings($code)['lang_name'] ?? strtoupper($code); ?>
<a href="<?= e(url($switchPage, $code)) ?>" hreflang="<?= e($code) ?>" lang="<?= e($code) ?>" title="<?= e($name) ?>"<?= $code === $LANG ? ' aria-current="true"' : '' ?>><span aria-hidden="true"><?= e(strtoupper($code)) ?></span><span class="sr-only"><?= e($name) ?></span></a>
<?php endforeach; ?>
</div>
<?php }; ?>
<header class="site-header">
<div class="header-inner">
<a href="<?= e(url('home')) ?>" class="brand" aria-label="<?= te('a11y.home') ?>"><?= nciata_mark(24, '#e8a317', 'nciata-mark brand-mark') ?><span class="brand-word">GanzaQuest</span></a>
<nav class="desktop-nav" aria-label="<?= te('a11y.main_nav') ?>">
<?php foreach (cfg('nav') as $item): ?>
<a href="<?= e(url($item)) ?>"<?= $item === (in_array($page, ['door-story', 'suspension-story', 'codex-house'], true) ? 'blog' : $page) ? ' class="active" aria-current="page"' : '' ?>><?= te('nav.' . $item) ?></a>
<?php endforeach; ?>
</nav>
<div class="header-actions">
<?php $langSwitch('lang-switch'); ?>
<a class="pill pill-small" href="<?= e(url('contact')) ?>"><?= te('header_cta') ?></a>
</div>
<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" data-label-open="<?= te('a11y.menu_open') ?>" data-label-close="<?= te('a11y.menu_close') ?>" aria-label="<?= te('a11y.menu_open') ?>">
<span class="menu-icon-open"><?= icon('menu', 22, 1.6) ?></span><span class="menu-icon-close"><?= icon('x', 22, 1.6) ?></span>
</button>
</div>
<nav class="mobile-nav" id="mobile-nav" aria-label="<?= te('a11y.mobile_nav') ?>" hidden>
<?php foreach (cfg('nav') as $item): ?>
<a href="<?= e(url($item)) ?>"<?= $item === (in_array($page, ['door-story', 'suspension-story', 'codex-house'], true) ? 'blog' : $page) ? ' class="active" aria-current="page"' : '' ?>><?= te('nav.' . $item) ?></a>
<?php endforeach; ?>
<?php $langSwitch('lang-switch lang-switch-mobile'); ?>
</nav>
</header>
