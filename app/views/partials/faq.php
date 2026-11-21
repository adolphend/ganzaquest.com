<section class="section faq">
<h2 class="headline center"><?= te('faq.title') ?></h2>
<div class="faq-list">
<?php foreach (t('faq.items') as $item): ?>
<details class="faq-item">
<summary><?= e($item['q']) ?><?= icon('chevron-down', 20, 2) ?></summary>
<p><?= e($item['a']) ?></p>
</details>
<?php endforeach; ?>
</div>
</section>
