<?php
/** @var string $page */
$switchPage = $page === '404' ? 'home' : $page;
$langSwitch = static function (string $class) use ($switchPage, $LANG): void { ?>
<div class="<?= e($class) ?>" role="group" aria-label="<?= te('a11y.language') ?>">
<?php foreach (cfg('languages') as $code):
    $name = load_strings($code)['lang_name'] ?? strtoupper($code); ?>
<a href="<?= e(url($switchPage, $code)) ?>" hreflang="<?= e($code) ?>" lang="<?= e($code) ?>" title="<?= e($name) ?>"<?= $code === $LANG ? ' aria-current="true"' : '' ?>><span aria-hidden="true"><?= e(strtoupper($code)) ?></span><span class="sr-only"><?= e($name) ?></span></a>
<?php endforeach; ?>
</div>
<?php }; ?>
<header class="site-header">
<a href="<?= e(url('home')) ?>" class="brand" aria-label="<?= te('a11y.home') ?>"><span class="brand-mark" aria-hidden="true">g<span>q</span></span><span>GANZA QUEST<small><?= te('brand.tagline') ?></small></span></a>
<nav class="desktop-nav" aria-label="<?= te('a11y.main_nav') ?>">
<?php foreach (cfg('nav') as $item): ?>
<a href="<?= e(url($item)) ?>"<?= $item === $page ? ' class="active" aria-current="page"' : '' ?>><?= te('nav.' . $item) ?></a>
<?php endforeach; ?>
</nav>
<div class="header-actions">
<?php $langSwitch('lang-switch'); ?>
<a class="header-cta" href="<?= e(url('contact')) ?>"><?= te('header_cta') ?> <?= icon('arrow-up-right', 17) ?></a>
</div>
<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" data-label-open="<?= te('a11y.menu_open') ?>" data-label-close="<?= te('a11y.menu_close') ?>" aria-label="<?= te('a11y.menu_open') ?>">
<span class="menu-icon-open"><?= icon('menu', 24) ?></span><span class="menu-icon-close"><?= icon('x', 24) ?></span>
</button>
<nav class="mobile-nav" id="mobile-nav" aria-label="<?= te('a11y.mobile_nav') ?>" hidden>
<?php foreach (cfg('nav') as $item): ?>
<a href="<?= e(url($item)) ?>"<?= $item === $page ? ' class="active" aria-current="page"' : '' ?>><?= te('nav.' . $item) ?><?= icon('arrow-up-right', 18) ?></a>
<?php endforeach; ?>
<?php $langSwitch('lang-switch lang-switch-mobile'); ?>
</nav>
</header>
