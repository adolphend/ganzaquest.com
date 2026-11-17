<section class="hero">
<p class="kicker"><?= te('hero.eyebrow') ?></p>
<h1 class="display"><?= te('hero.title_1') ?><br><?= te('hero.title_2') ?> <span class="accent"><?= te('hero.title_2_em') ?></span></h1>
<p class="lede"><?= str_replace("\n", '<br class="desktop-break"> ', te('hero.description')) ?></p>
<div class="actions">
<a class="pill" href="<?= e(url('contact')) ?>"><?= te('hero.cta_primary') ?></a>
<a class="more-link" href="<?= e(url('services')) ?>"><?= te('hero.cta_secondary') ?> <?= icon('chevron-right', 16, 2.2) ?></a>
</div>
<div class="hero-visual"><?= nciata_illustration(420) ?></div>
<p class="hero-note"><?= te('hero.note') ?></p>
</section>
<?php render('partials/services'); ?>
<section class="story">
<p class="kicker"><?= te('story.eyebrow') ?></p>
<h2 class="display"><?= te('story.title_1') ?> <?= te('story.title_2') ?> <span class="accent-light"><?= te('story.title_3') ?></span></h2>
<p class="lede"><?= tbr('story.large') ?></p>
<div class="story-copy">
<p><?= te('story.p1') ?></p>
<p><?= te('story.p2') ?></p>
</div>
<a class="more-link" href="<?= e(url('about')) ?>"><?= te('story.link') ?> <?= icon('chevron-right', 16, 2.2) ?></a>
</section>
<?php render('partials/cta'); ?>
