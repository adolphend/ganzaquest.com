<section class="journal-index section" aria-label="<?= e($storyUI['articles']) ?>">
<article class="journal-feature" lang="<?= e($LANG) ?>">
<a class="journal-image" href="<?= e(url('door-story')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/mary-chris-door.webp')) ?>" width="1536" height="1024" alt=""></a>
<div><p class="journal-topic"><?= e($story[0]) ?></p><h2><a href="<?= e(url('door-story')) ?>"><?= e($storyUI['title']) ?></a></h2><p><?= e($storyUI['excerpt']) ?></p><a class="pill" href="<?= e(url('door-story')) ?>"><?= e($storyUI['read']) ?></a><p class="journal-time"><?= e($storyUI['time']) ?></p></div>
</article>
<article class="journal-feature codex-house-feature" lang="<?= e($LANG) ?>">
<a class="journal-image" href="<?= e(url('codex-house')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/codex-house-model.png')) ?>" width="1600" height="1200" loading="lazy" alt=""></a>
<div><p class="journal-topic"><?= e($house['ui']['topic']) ?></p><h2><a href="<?= e(url('codex-house')) ?>"><?= e($house['ui']['title']) ?></a></h2><p><?= e($house['ui']['excerpt']) ?></p><a class="pill" href="<?= e(url('codex-house')) ?>"><?= e($house['ui']['read']) ?></a><p class="journal-time"><?= e($house['ui']['time']) ?></p></div>
</article>
<article class="journal-feature suspension-feature" lang="<?= e($LANG) ?>">
<a class="journal-image" href="<?= e(url('suspension-story')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/suspension-model-neutral.svg')) ?>" width="800" height="600" loading="lazy" alt=""></a>
<div><p class="journal-topic"><?= e($suspensionUI['topic']) ?></p><h2><a href="<?= e(url('suspension-story')) ?>"><?= e($suspensionUI['title']) ?></a></h2><p><?= e($suspensionUI['excerpt']) ?></p><a class="pill" href="<?= e(url('suspension-story')) ?>"><?= e($suspensionUI['read']) ?></a><p class="journal-time"><?= e($suspensionUI['time']) ?></p></div>
</article>
</section>
