<nav class="story-breadcrumb" aria-label="<?= e($storyUI['breadcrumb']) ?>">
<a href="<?= e(url('home')) ?>"><?= te('nav.home') ?></a><span>/</span>
<a href="<?= e(url('blog')) ?>"><?= te('nav.blog') ?></a><span>/</span>
<span aria-current="page"><?= e($storyUI['title']) ?></span></nav>
<?php render('partials/door-story', ['story' => $story, 'storyUI' => $storyUI]); ?>
