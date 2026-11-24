<section class="hero">
<div class="hero-copy">
<p class="kicker"><?= te('hero.eyebrow') ?></p>
<h1 class="display"><?= te('hero.title_1') ?><br><?= te('hero.title_2') ?> <span class="accent"><?= te('hero.title_2_em') ?></span></h1>
<p class="lede"><?= str_replace("\n", '<br class="desktop-break"> ', te('hero.description')) ?></p>
<div class="actions">
<a class="pill" href="<?= e(url('contact')) ?>"><?= te('hero.cta_primary') ?></a>
<a class="more-link" href="<?= e(url('services')) ?>"><?= te('hero.cta_secondary') ?> <?= icon('chevron-right', 16, 2.2) ?></a>
</div>
<p class="hero-note"><?= te('hero.note') ?></p>
</div>
<div class="hero-visual" aria-hidden="true"><?= nciata_illustration(420) ?></div>
</section>
<?php render('partials/services'); ?>
<?php render('partials/cta'); ?>
