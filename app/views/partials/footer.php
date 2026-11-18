<footer class="site-footer">
<div class="footer-inner">
<div class="footer-top">
<a class="footer-brand" href="<?= e(url('home')) ?>"><?= nciata_mark(28, '#e8a317') ?><span>GanzaQuest</span></a>
<p class="footer-motto"><?= te('brand.motto') ?></p>
</div>
<nav class="footer-nav" aria-label="<?= te('a11y.footer_nav') ?>">
<?php foreach (array_slice(cfg('nav'), 1) as $item): ?>
<a href="<?= e(url($item)) ?>"><?= te('nav.' . $item) ?></a>
<?php endforeach; ?>
<a href="<?= e(url('privacy')) ?>"><?= te('nav.privacy') ?></a>
</nav>
<div class="footer-bottom">
<p>© <?= date('Y') ?> NCIATA Ltd. <?= te('footer.rights') ?> <?= te('footer.brand_line') ?></p>
<p><?= te('brand.tagline') ?></p>
</div>
</div>
</footer>
