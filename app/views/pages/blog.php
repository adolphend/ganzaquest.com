<section class="journal-index section" aria-label="<?= e($storyUI['articles']) ?>">
<article class="journal-feature" lang="<?= e($LANG) ?>">
<a class="journal-image" href="<?= e(url('door-story')) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(asset('img/mary-chris-door.webp')) ?>" width="1536" height="1024" alt=""></a>
<div><p class="journal-topic"><?= e($story[0]) ?></p><h2><a href="<?= e(url('door-story')) ?>"><?= e($storyUI['title']) ?></a></h2><p><?= e($storyUI['excerpt']) ?></p><a class="pill" href="<?= e(url('door-story')) ?>"><?= e($storyUI['read']) ?></a><p class="journal-time"><?= e($storyUI['time']) ?></p></div>
</article></section>
