<section class="section prose">
<?php if (t('privacy.translation_note') !== ''): ?>
<p class="translation-note"><?= te('privacy.translation_note') ?></p>
<?php endif; ?>
<?php foreach (t('privacy.sections') as $section): ?>
<h2><?= e($section['title']) ?></h2>
<p><?= nl2br(e($section['text']), false) ?></p>
<?php endforeach; ?>
</section>
