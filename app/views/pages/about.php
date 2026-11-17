<section class="about-content section-rail">
<?php foreach (t('about.meanings') as $meaning): ?>
<div class="meaning">
<span><?= e($meaning['tag']) ?></span>
<h2><?= e($meaning['title']) ?></h2>
<p><?= e($meaning['text']) ?></p>
</div>
<?php endforeach; ?>
<div class="about-manifesto">
<h2><?= tbr('about.manifesto_title') ?></h2>
<p><?= te('about.manifesto_text') ?></p>
</div>
<div class="meaning origin">
<span><?= te('about.origin_tag') ?></span>
<h2><?= te('about.origin_title') ?></h2>
<p><?= te('about.origin_text') ?></p>
</div>
</section>
