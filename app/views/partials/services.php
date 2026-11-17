<?php $detailed = $detailed ?? false; ?>
<section class="section services" id="servicios">
<div class="section-head">
<p class="kicker"><?= te('services.eyebrow') ?></p>
<h2 class="headline"><?= tbr('services.title') ?></h2>
<p class="lede"><?= tbr('services.intro') ?></p>
</div>
<div class="tile-grid">
<?php foreach (t('services.items') as $i => $service): ?>
<article class="tile<?= $i === 1 || $i === 2 ? ' tile-dark' : '' ?>">
<span class="tile-icon"><?= icon($service['icon'], 40, 1.4) ?></span>
<h3><?= e($service['title']) ?></h3>
<p class="tile-short"><?= e($service['short']) ?></p>
<?php if ($detailed): ?>
<p class="tile-text"><?= e($service['description']) ?></p>
<ul class="tags"><?php foreach ($service['tags'] as $tag): ?><li><?= e($tag) ?></li><?php endforeach; ?></ul>
<?php endif; ?>
<a class="more-link" href="<?= e(url($detailed ? 'contact' : 'services')) ?>" aria-label="<?= e(($detailed ? t('services.ask_label') : t('services.more_label')) . ' ' . $service['title']) ?>"><?= te($detailed ? 'services.ask' : 'services.more') ?> <?= icon('chevron-right', 16, 2.2) ?></a>
</article>
<?php endforeach; ?>
</div>
</section>
