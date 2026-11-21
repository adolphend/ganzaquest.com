<section class="journal-index section" aria-label="<?= e($storyUI['articles']) ?>">
<article class="journal-feature" lang="<?= e($LANG) ?>">
<a class="journal-image" href="<?= e(url('door-story')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/mary-chris-door.webp')) ?>" width="1536" height="1024" alt=""></a>
<div><p class="journal-topic"><?= e($story[0]) ?></p><h2><a href="<?= e(url('door-story')) ?>"><?= e($storyUI['title']) ?></a></h2><p><?= e($storyUI['excerpt']) ?></p><a class="pill" href="<?= e(url('door-story')) ?>"><?= e($storyUI['read']) ?></a><p class="journal-time"><?= e($storyUI['time']) ?></p></div>
</article>
<?php if ($LANG === 'en'): ?>
<article class="journal-feature suspension-feature">
<a class="journal-image" href="<?= e(url('suspension-story')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/suspension-model.svg')) ?>" width="800" height="600" loading="lazy" alt=""></a>
<div><p class="journal-topic">AI agents in everyday engineering</p><h2><a href="<?= e(url('suspension-story')) ?>">What Would You Ask It to Do?</a></h2><p>A car crosses a speed bump. An agent investigates a gentler ride. The result raises a question about how we ask AI to work.</p><a class="pill" href="<?= e(url('suspension-story')) ?>">Read the story</a><p class="journal-time">An engineering case study &middot; 8-minute read &middot; English</p></div>
</article>
<?php endif; ?></section>
