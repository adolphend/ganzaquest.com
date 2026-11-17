<?php /** @var string $kind blog|products */ $data = t('empty.' . $kind); ?>
<section class="empty-section section-rail">
<div class="empty-icon"><?= icon($kind === 'blog' ? 'book-open' : 'layers', 36, 1.3) ?></div>
<p class="eyebrow dark-eyebrow"><?= e($data['eyebrow']) ?></p>
<h2><?= e($data['title']) ?></h2>
<p><?= e($data['text']) ?></p>
<a class="text-link navy-link" href="<?= e(url($data['target'])) ?>"><?= e($data['link']) ?> <?= icon('arrow-up-right', 19) ?></a>
</section>
