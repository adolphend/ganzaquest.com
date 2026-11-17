<section class="section">
<div class="tile-grid">
<?php foreach (t('about.meanings') as $meaning): ?>
<article class="tile">
<p class="tile-tag"><?= e($meaning['tag']) ?></p>
<h2 class="tile-headline"><?= e($meaning['title']) ?></h2>
<p class="tile-text"><?= e($meaning['text']) ?></p>
</article>
<?php endforeach; ?>
<article class="tile tile-dark tile-wide">
<h2 class="tile-headline"><?= tbr('about.manifesto_title') ?></h2>
<p class="tile-text"><?= te('about.manifesto_text') ?></p>
</article>
<article class="tile tile-wide tile-feature">
<div class="tile-feature-copy">
<p class="tile-tag"><?= te('about.origin_tag') ?></p>
<h2 class="tile-headline"><?= te('about.origin_title') ?></h2>
<p class="tile-text"><?= te('about.origin_text') ?></p>
</div>
<div class="tile-feature-visual"><?= nciata_illustration(300, 'NCIATA') ?></div>
</article>
</div>
</section>
