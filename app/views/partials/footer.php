<footer class="site-footer">
<div class="footer-top">
<div><a class="footer-brand" href="<?= e(url('home')) ?>">GANZA QUEST<span><?= te('brand.motto') ?></span><span class="footer-owner"><?= te('brand.owner') ?></span></a></div>
<nav aria-label="<?= te('a11y.footer_nav') ?>">
<?php foreach (array_slice(cfg('nav'), 1) as $item): ?>
<a href="<?= e(url($item)) ?>"><?= te('nav.' . $item) ?></a>
<?php endforeach; ?>
</nav>
<a href="<?= e(url('contact')) ?>" class="footer-contact"><?= te('footer.connect') ?> <?= icon('arrow-up-right', 20) ?></a>
</div>
<div class="footer-bottom">
<span>© <?= date('Y') ?> NCIATA Ltd. <?= te('footer.rights') ?> <?= te('footer.brand_line') ?></span>
<a href="<?= e(url('privacy')) ?>"><?= te('nav.privacy') ?></a>
<span><?= te('brand.tagline') ?>.</span>
</div>
</footer>
