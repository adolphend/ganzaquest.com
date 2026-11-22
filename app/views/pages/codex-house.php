<?php
/** @var array $house */
$ui = $house['ui'];
$paragraphs = static function (array $items): void {
    foreach ($items as $item) {
        echo '<p>' . e($item) . '</p>';
    }
};
?>
<nav class="story-breadcrumb" aria-label="<?= e($ui['breadcrumb']) ?>">
<a href="<?= e(url('home')) ?>"><?= te('nav.home') ?></a><span>/</span>
<a href="<?= e(url('blog')) ?>"><?= te('nav.blog') ?></a><span>/</span>
<span aria-current="page"><?= e($ui['title']) ?></span></nav>
<article class="door-story codex-house-story" lang="<?= e($LANG) ?>">
<header class="story-hero">
<div class="story-hero-copy"><p class="eyebrow"><?= e($ui['topic']) ?></p>
<h1><?= e($ui['title']) ?></h1>
<p class="standfirst"><?= e($house['hero']['standfirst']) ?></p>
<p class="story-meta"><?= e($house['hero']['meta']) ?></p>
<a class="read-link" href="#begin"><?= e($house['hero']['start']) ?></a></div>
<figure class="story-illustration"><img src="<?= e(asset('img/codex-house-model.png')) ?>" width="1600" height="1200" fetchpriority="high" alt="<?= e($house['hero']['alt']) ?>"><figcaption><?= e($house['hero']['caption']) ?></figcaption></figure>
</header>
<div class="story-body">
<section class="story-chapter" id="begin"><h2><?= e($house['intro']['title']) ?></h2><?php $paragraphs($house['intro']['paragraphs']); ?></section>
<section class="story-chapter house-tour" id="house-tour"><h2><?= e($house['tour']['title']) ?></h2><p><?= e($house['tour']['intro']) ?></p>
<figure class="house-tour-overview"><div class="house-tour-frame"><img src="<?= e(asset('img/codex-house-walkthrough.png')) ?>" width="1158" height="1057" loading="lazy" alt="<?= e($house['tour']['overview_alt']) ?>">
<?php foreach ($house['tour']['rooms'] as $index => $room): ?><span class="house-room-marker house-room-marker-<?= e((string) ($index + 1)) ?>" aria-hidden="true"><?= e((string) ($index + 1)) ?></span><?php endforeach; ?>
</div><figcaption><?= e($house['tour']['overview_caption']) ?></figcaption></figure>
<h3 class="house-key-title"><?= e($house['tour']['key_title']) ?></h3><ol class="house-room-key"><?php foreach ($house['tour']['rooms'] as $index => $room): ?><li><span class="house-key-number" aria-hidden="true"><?= e((string) ($index + 1)) ?></span><span><?= e($room) ?></span></li><?php endforeach; ?></ol>
<div class="house-angles"><figure><img src="<?= e(asset('img/codex-house-front.png')) ?>" width="1158" height="954" loading="lazy" alt="<?= e($house['tour']['front_alt']) ?>"><figcaption><?= e($house['tour']['front_caption']) ?></figcaption></figure><figure><img src="<?= e(asset('img/codex-house-rear.png')) ?>" width="1291" height="1163" loading="lazy" alt="<?= e($house['tour']['rear_alt']) ?>"><figcaption><?= e($house['tour']['rear_caption']) ?></figcaption></figure></div>
<p class="house-figure-note"><?= e($house['tour']['note']) ?></p></section>
<aside class="decision" aria-labelledby="house-question-title"><p class="eyebrow"><?= e($house['question']['label']) ?></p><h2 id="house-question-title"><?= e($house['question']['title']) ?></h2><p><?= e($house['question']['intro']) ?></p>
<?php foreach ($house['question']['choices'] as $choice): ?><details><summary><?= e($choice['title']) ?></summary><p><?= e($choice['answer']) ?></p></details><?php endforeach; ?></aside>
<section class="story-chapter" id="brief"><h2><?= e($house['brief']['title']) ?></h2><?php $paragraphs($house['brief']['paragraphs']); ?></section>
<section class="story-chapter" id="setup"><h2><?= e($house['setup']['title']) ?></h2><?php $paragraphs($house['setup']['paragraphs']); ?>
<ol class="house-steps"><?php foreach ($house['setup']['steps'] as $step): ?><li><strong><?= e($step['title']) ?></strong><p><?= e($step['text']) ?></p></li><?php endforeach; ?></ol>
<p><?= e($house['setup']['code_intro']) ?></p><pre class="house-code"><code>node --version
npm --version
npm install -g @openai/codex
codex --version
codex</code></pre><p><?= e($house['setup']['code_note']) ?></p>
<p class="house-links"><a href="https://developers.openai.com/codex/cli/"><?= e($house['setup']['codex_link']) ?></a><span aria-hidden="true"> · </span><a href="https://nodejs.org/en/download"><?= e($house['setup']['node_link']) ?></a><span aria-hidden="true"> · </span><a href="https://www.freecad.org/downloads.php"><?= e($house['setup']['freecad_link']) ?></a></p></section>
<section class="story-chapter" id="time"><h2><?= e($house['timing']['title']) ?></h2><p><?= e($house['timing']['intro']) ?></p>
<div class="house-timing"><div><strong>7 min 41 s</strong><span><?= e($house['timing']['first']) ?></span></div><div><strong>10 min 48 s</strong><span><?= e($house['timing']['last']) ?></span></div></div>
<p><?= e($house['timing']['note']) ?></p></section>
<section class="story-chapter" id="model"><h2><?= e($house['evolution']['title']) ?></h2><?php $paragraphs($house['evolution']['paragraphs']); ?>
<div class="house-plans"><figure><img src="<?= e(asset('img/codex-house-plan-v01.png')) ?>" width="1600" height="1200" loading="lazy" alt="<?= e($house['evolution']['before_alt']) ?>"><figcaption><?= e($house['evolution']['before_caption']) ?></figcaption></figure><figure><img src="<?= e(asset('img/codex-house-plan-v04.png')) ?>" width="1600" height="1200" loading="lazy" alt="<?= e($house['evolution']['after_alt']) ?>"><figcaption><?= e($house['evolution']['after_caption']) ?></figcaption></figure></div>
<p class="house-figure-note"><?= e($house['evolution']['legend']) ?></p>
<p class="house-figure-note"><?= e($house['evolution']['figure_note']) ?></p>
<ul class="house-versions"><?php foreach ($house['evolution']['versions'] as $version): ?><li><strong><?= e($version['title']) ?></strong> <?= e($version['text']) ?></li><?php endforeach; ?></ul>
<p><?= e($house['evolution']['correction']) ?></p></section>
<section class="story-chapter" id="review"><h2><?= e($house['review']['title']) ?></h2><?php $paragraphs($house['review']['paragraphs']); ?></section>
<aside class="decision" aria-labelledby="house-review-title"><p class="eyebrow"><?= e($house['reflection']['label']) ?></p><h2 id="house-review-title"><?= e($house['reflection']['title']) ?></h2><details><summary><?= e($house['reflection']['summary']) ?></summary><p><?= e($house['reflection']['answer']) ?></p></details></aside>
<section class="story-chapter" id="potential"><h2><?= e($house['potential']['title']) ?></h2><?php $paragraphs($house['potential']['paragraphs']); ?></section>
<footer class="story-ending"><p class="eyebrow"><?= e($house['ending']['label']) ?></p><p><?= e($house['ending']['message']) ?></p><a href="#begin"><?= e($house['ending']['back']) ?></a></footer>
<section class="story-chapter house-notes" aria-labelledby="house-evidence-title"><h2 id="house-evidence-title"><?= e($house['evidence']['title']) ?></h2><p><?= e($house['evidence']['text']) ?></p><p><a href="<?= e(asset('data/codex-house-evidence.json')) ?>"><?= e($house['evidence']['link']) ?></a></p></section>
</div></article>
