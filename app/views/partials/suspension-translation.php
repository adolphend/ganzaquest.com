<?php
/** @var array $suspension @var array $suspensionUI */
$s = $suspension;
$paragraphs = static function (array $items): void {
    foreach ($items as $item) {
        echo '<p>' . e($item) . '</p>';
    }
};
$chapter = static function (string $id, array $data) use ($paragraphs): void {
    echo '<section class="story-chapter" id="' . e($id) . '"><h2>' . e($data['title']) . '</h2>';
    $paragraphs($data['paragraphs']);
    echo '</section>';
};
?>
<nav class="story-breadcrumb" aria-label="<?= e($suspensionUI['breadcrumb']) ?>">
<a href="<?= e(url('home')) ?>"><?= te('nav.home') ?></a><span>/</span>
<a href="<?= e(url('blog')) ?>"><?= te('nav.blog') ?></a><span>/</span>
<span aria-current="page"><?= e($suspensionUI['title']) ?></span></nav>
<article class="door-story suspension-story" lang="<?= e($LANG) ?>">
<header class="story-hero"><div class="story-hero-copy"><p class="eyebrow"><?= e($suspensionUI['topic']) ?></p>
<h1><?= e($suspensionUI['title']) ?></h1><p class="standfirst"><?= e($s['hero']['standfirst']) ?></p>
<p class="story-meta"><?= e($s['hero']['meta']) ?></p><a class="read-link" href="#bump"><?= e($s['hero']['start']) ?></a></div>
<figure class="story-illustration"><svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600" role="img" aria-label="<?= e($s['hero']['diagram_alt']) ?>">
<rect width="800" height="600" rx="24" fill="#e5eef2"/>
<g stroke="#153b48" stroke-width="6" stroke-linejoin="round" fill="none"><rect x="180" y="80" width="440" height="105" rx="22" fill="#153b48"/><path d="M285 185v30l-30 18 60 26-60 26 60 26-60 26 30 18v35"/><path d="M495 185v65m-30 0h60v65h-60zm30 65v75"/><path d="M260 390h260"/><circle cx="390" cy="438" r="48" fill="#fff"/><circle cx="390" cy="438" r="18"/><path d="M60 535h180c60 0 80-49 150-49s90 49 150 49h200" stroke="#b27725"/></g>
<g aria-hidden="true" font-family="Arial,sans-serif" font-size="24" text-anchor="middle"><text x="400" y="145" fill="#fff"><?= e($s['hero']['labels']['body']) ?></text><g fill="#153b48"><text x="190" y="290"><?= e($s['hero']['labels']['spring']) ?></text><text x="600" y="290"><?= e($s['hero']['labels']['damper']) ?></text><text x="575" y="445"><?= e($s['hero']['labels']['wheel']) ?></text><text x="400" y="580"><?= e($s['hero']['labels']['road']) ?></text></g></g></svg>
<figcaption><?= e($s['hero']['caption']) ?></figcaption></figure></header>
<div class="story-body"><?php $chapter('bump', $s['bump']); ?>
<aside class="decision" aria-labelledby="decision-title"><p class="eyebrow"><?= e($s['decision']['label']) ?></p><h2 id="decision-title"><?= e($s['decision']['title']) ?></h2><p><?= e($s['decision']['intro']) ?></p><?php foreach ($s['decision']['choices'] as $choice): ?><details><summary><?= e($choice['title']) ?></summary><p><?= e($choice['answer']) ?></p></details><?php endforeach; ?></aside>
<?php $chapter('assignment', $s['assignment']); $chapter('tools', $s['tools']); $chapter('model', $s['model']); $chapter('search', $s['search']); ?>
<section class="story-chapter" id="result"><h2><?= e($s['result']['title']) ?></h2><?php $paragraphs($s['result']['before']); ?>
<figure class="suspension-result"><a href="<?= e(asset('img/suspension-holdout.png')) ?>"><img src="<?= e(asset('img/suspension-holdout.png')) ?>" width="2634" height="1978" loading="lazy" alt="<?= e($s['result']['plot_alt']) ?>"></a><figcaption><?= e($s['result']['plot_caption']) ?></figcaption></figure>
<?php $paragraphs($s['result']['after']); ?></section>
<aside class="decision" aria-labelledby="review-title"><p class="eyebrow"><?= e($s['review']['label']) ?></p><h2 id="review-title"><?= e($s['review']['title']) ?></h2><details><summary><?= e($s['review']['summary']) ?></summary><p><?= e($s['review']['answer']) ?></p></details></aside>
<?php $chapter('work', $s['work']); ?>
<footer class="story-ending"><p class="eyebrow"><?= e($s['ending']['label']) ?></p><p><?= e($s['ending']['question']) ?></p><p><?= e($s['ending']['follow']) ?></p><a href="#bump"><?= e($s['ending']['back']) ?></a></footer>
<section class="story-chapter suspension-notes" aria-labelledby="evidence-title"><h2 id="evidence-title"><?= e($s['evidence']['title']) ?></h2><p><?= e($s['evidence']['intro']) ?></p>
<p><a href="<?= e(asset('data/suspension-evidence.json')) ?>"><?= e($s['evidence']['link']) ?></a>. <?= e($s['evidence']['parameters']) ?></p>
<p><?= e($s['evidence']['projects']) ?> <a href="https://github.com/matlab/agentic-toolkit-installer">Agentic Toolkit Installer</a>, <a href="https://github.com/matlab/matlab-mcp-server">MATLAB MCP Server</a>, <a href="https://github.com/matlab/matlab-agentic-toolkit">MATLAB Agentic Toolkit</a>, <a href="https://github.com/matlab/simulink-agentic-toolkit">Simulink Agentic Toolkit</a>.</p></section>
</div></article>
