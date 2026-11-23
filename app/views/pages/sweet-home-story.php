<?php
/** @var array $sweetHome */
$ui = $sweetHome['ui'];
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
<article class="door-story codex-house-story sweet-home-story" lang="<?= e($LANG) ?>">
<header class="story-hero">
<div class="story-hero-copy"><p class="eyebrow"><?= e($ui['topic']) ?></p>
<h1><?= e($ui['title']) ?></h1><p class="standfirst"><?= e($sweetHome['hero']['standfirst']) ?></p>
<p class="story-meta"><?= e($sweetHome['hero']['meta']) ?></p>
<a class="read-link" href="#begin"><?= e($sweetHome['hero']['start']) ?></a></div>
<figure class="story-illustration"><img src="<?= e(asset('img/sweet-home-overview.png')) ?>" width="1400" height="1050" fetchpriority="high" alt="<?= e($sweetHome['hero']['alt']) ?>"><figcaption><?= e($sweetHome['hero']['caption']) ?></figcaption></figure>
</header>
<div class="story-body">
<section class="story-chapter" id="begin"><h2><?= e($sweetHome['intro']['title']) ?></h2><?php $paragraphs($sweetHome['intro']['paragraphs']); ?></section>
<section class="story-chapter house-tour" id="tour"><h2><?= e($sweetHome['tour']['title']) ?></h2><p><?= e($sweetHome['tour']['intro']) ?></p>
<figure class="house-tour-overview"><div class="house-tour-frame"><img src="<?= e(asset('img/sweet-home-v04-plan.png')) ?>" width="1665" height="1465" loading="lazy" alt="<?= e($sweetHome['tour']['plan_alt']) ?>"></div><figcaption><?= e($sweetHome['tour']['plan_caption']) ?></figcaption></figure>
<div class="house-angles"><figure><img src="<?= e(asset('img/sweet-home-front.png')) ?>" width="1400" height="1050" loading="lazy" alt="<?= e($sweetHome['tour']['front_alt']) ?>"><figcaption><?= e($sweetHome['tour']['front_caption']) ?></figcaption></figure><figure><img src="<?= e(asset('img/sweet-home-rear.png')) ?>" width="1400" height="1050" loading="lazy" alt="<?= e($sweetHome['tour']['rear_alt']) ?>"><figcaption><?= e($sweetHome['tour']['rear_caption']) ?></figcaption></figure></div>
<p class="house-figure-note"><?= e($sweetHome['tour']['note']) ?></p></section>
<aside class="decision" aria-labelledby="sweet-question-title"><p class="eyebrow"><?= e($sweetHome['question']['label']) ?></p><h2 id="sweet-question-title"><?= e($sweetHome['question']['title']) ?></h2>
<?php foreach ($sweetHome['question']['choices'] as $choice): ?><details><summary><?= e($choice['title']) ?></summary><p><?= e($choice['answer']) ?></p></details><?php endforeach; ?></aside>
<section class="story-chapter" id="making"><h2><?= e($sweetHome['setup']['title']) ?></h2><?php $paragraphs($sweetHome['setup']['paragraphs']); ?>
<p class="house-links"><a href="https://www.sweethome3d.com/download/"><?= e($sweetHome['setup']['download']) ?></a><span aria-hidden="true"> · </span><a href="https://www.sweethome3d.com/users-guide/"><?= e($sweetHome['setup']['guide']) ?></a></p></section>
<section class="story-chapter" id="time"><h2><?= e($sweetHome['timing']['title']) ?></h2><?php $paragraphs($sweetHome['timing']['paragraphs']); ?></section>
<section class="story-chapter" id="revisions"><h2><?= e($sweetHome['evolution']['title']) ?></h2><?php $paragraphs($sweetHome['evolution']['paragraphs']); ?>
<div class="house-plans"><figure><img src="<?= e(asset('img/sweet-home-v01-plan.png')) ?>" width="1665" height="1367" loading="lazy" alt="<?= e($sweetHome['evolution']['before_alt']) ?>"><figcaption><?= e($sweetHome['evolution']['before_caption']) ?></figcaption></figure><figure><img src="<?= e(asset('img/sweet-home-v04-plan.png')) ?>" width="1665" height="1465" loading="lazy" alt="<?= e($sweetHome['evolution']['after_alt']) ?>"><figcaption><?= e($sweetHome['evolution']['after_caption']) ?></figcaption></figure></div>
<p class="house-figure-note"><?= e($sweetHome['evolution']['note']) ?></p>
<ol class="house-versions"><?php foreach ($sweetHome['evolution']['versions'] as $version): ?><li><strong><?= e($version['title']) ?></strong> <?= e($version['text']) ?></li><?php endforeach; ?></ol></section>
<section class="story-chapter" id="review"><h2><?= e($sweetHome['review']['title']) ?></h2><?php $paragraphs($sweetHome['review']['paragraphs']); ?></section>
<section class="story-chapter house-roadmap" id="other-tools"><p class="eyebrow"><?= e($sweetHome['strategy']['label']) ?></p><h2><?= e($sweetHome['strategy']['title']) ?></h2><p><?= e($sweetHome['strategy']['intro']) ?></p>
<ol class="house-roadmap-steps"><?php foreach ($sweetHome['strategy']['steps'] as $step): ?><li><h3><?= e($step['title']) ?></h3><p><?= e($step['text']) ?></p></li><?php endforeach; ?></ol>
<p><?= e($sweetHome['strategy']['note']) ?></p><p><a href="<?= e(url('codex-house')) ?>#other-design-tools"><?= e($sweetHome['strategy']['link']) ?></a> · <a href="https://www.sweethome3d.com/users-guide/"><?= e($sweetHome['strategy']['export_link']) ?></a></p></section>
<footer class="story-ending"><p class="eyebrow"><?= e($sweetHome['ending']['label']) ?></p><p><?= e($sweetHome['ending']['message']) ?></p><a href="#begin"><?= e($sweetHome['ending']['back']) ?></a></footer>
</div></article>
