<?php
header('Content-Type: application/xml; charset=utf-8');
$pages = array_keys(cfg('slugs')[cfg('default_lang')]);
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($pages as $page): foreach (cfg('languages') as $lang): ?>
<url>
<loc><?= e(absolute_url(url($page, $lang))) ?></loc>
<?php foreach (cfg('languages') as $alt): ?>
<xhtml:link rel="alternate" hreflang="<?= e($alt) ?>" href="<?= e(absolute_url(url($page, $alt))) ?>"/>
<?php endforeach; ?>
<xhtml:link rel="alternate" hreflang="x-default" href="<?= e(absolute_url(url($page, cfg('default_lang')))) ?>"/>
</url>
<?php endforeach; endforeach; ?>
</urlset>
