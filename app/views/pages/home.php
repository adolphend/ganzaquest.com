<section class="hero">
<div class="hero-grid" aria-hidden="true"></div>
<div class="hero-orbit" aria-hidden="true"><div></div><div></div><span><?= nciata_mark(190) ?></span></div>
<div class="hero-content">
<p class="eyebrow"><span class="status-dot"></span> <?= te('hero.eyebrow') ?></p>
<h1><?= te('hero.title_1') ?><br><?= te('hero.title_2') ?> <span><?= te('hero.title_2_em') ?></span></h1>
<p class="hero-description"><?= str_replace("\n", '<br class="desktop-break"> ', te('hero.description')) ?></p>
<div class="hero-actions">
<a class="button button-blue" href="<?= e(url('contact')) ?>"><?= te('hero.cta_primary') ?> <?= icon('arrow-up-right', 19) ?></a>
<a class="text-link" href="<?= e(url('services')) ?>"><?= te('hero.cta_secondary') ?> <?= icon('arrow-up-right', 19) ?></a>
</div>
<div class="hero-note"><?= icon('sparkles', 16) ?><span><?= te('hero.note') ?></span></div>
</div>
<div class="hero-bottom">
<span><?= te('hero.bottom_left') ?></span>
<a href="#servicios" aria-label="<?= te('hero.discover_label') ?>"><?= icon('arrow-down', 19) ?> <?= te('hero.discover') ?></a>
<span class="hero-coordinate"><?= te('hero.coordinate') ?></span>
</div>
</section>
<?php render('partials/services'); ?>
<section class="story-section section-rail">
<div>
<p class="eyebrow dark-eyebrow"><?= te('story.eyebrow') ?></p>
<h2><?= te('story.title_1') ?><br><?= te('story.title_2') ?><br><span><?= te('story.title_3') ?></span></h2>
</div>
<div class="story-copy">
<p class="large-copy"><?= tbr('story.large') ?></p>
<p><?= te('story.p1') ?></p>
<p><?= te('story.p2') ?></p>
<a class="text-link navy-link" href="<?= e(url('about')) ?>"><?= te('story.link') ?> <?= icon('arrow-up-right', 19) ?></a>
</div>
<span class="cropped-word" aria-hidden="true">QUEST</span>
</section>
<?php render('partials/cta'); ?>
