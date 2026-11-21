<?php /** @var string $kind blog|products */ $data = t('empty.' . $kind); ?>
<section class="section">
<div class="cta-tile empty-tile">
<span class="tile-icon"><?= icon($kind === 'blog' ? 'book-open' : 'layers', 44, 1.3) ?></span>
<p class="kicker"><?= e($data['eyebrow']) ?></p>
<h2 class="headline"><?= e($data['title']) ?></h2>
<p class="lede"><?= e($data['text']) ?></p>
<a class="more-link" href="<?= e(url($data['target'])) ?>"><?= e($data['link']) ?> <?= icon('chevron-right', 16, 2.2) ?></a>
</div>
</section>
