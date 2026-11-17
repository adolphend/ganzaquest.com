<?php $detailed = $detailed ?? false; ?>
<section class="services-section section-rail" id="servicios">
<div class="section-heading">
<div>
<p class="eyebrow dark-eyebrow"><?= te('services.eyebrow') ?></p>
<h2><?= tbr('services.title') ?></h2>
</div>
<p><?= tbr('services.intro') ?></p>
</div>
<div class="service-grid">
<?php foreach (t('services.items') as $i => $service): ?>
<article class="service-item">
<div class="service-top"><?= icon($service['icon'], 28, 1.5) ?><span><?= sprintf('%02d', $i + 1) ?></span></div>
<h3><?= e($service['title']) ?></h3>
<p><?= e($detailed ? $service['description'] : $service['short']) ?></p>
<?php if ($detailed): ?>
<div class="tags"><?php foreach ($service['tags'] as $tag): ?><span><?= e($tag) ?></span><?php endforeach; ?></div>
<?php endif; ?>
<a href="<?= e(url($detailed ? 'contact' : 'services')) ?>" aria-label="<?= e(($detailed ? t('services.ask_label') : t('services.more_label')) . ' ' . $service['title']) ?>"><?= te($detailed ? 'services.ask' : 'services.more') ?> <?= icon('arrow-up-right', 18) ?></a>
</article>
<?php endforeach; ?>
</div>
</section>
