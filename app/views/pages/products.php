<?php
/** @var array $form */
$errorKeys = [
    'email' => 'course.error_email',
    'rate' => 'contact.error_rate',
    'expired' => 'contact.error_expired',
    'send' => 'course.error_send',
];
$courseStartingPrice = 'US$499';
$courseForm = ($form['kind'] ?? null) === 'course' ? $form : [];
$errorKey = $errorKeys[$courseForm['error'] ?? ''] ?? null;
?>
<section class="section" aria-label="<?= te('nav.products') ?>">
<ul class="product-grid">
<li>
<article class="product-card" aria-labelledby="course-title">
<div class="product-art" aria-hidden="true">
<span class="product-art-plate"><?= icon('lock', 41, 1.4) ?></span>
</div>
<div class="product-content">
<p class="product-category"><?= te('course.category') ?> <span class="product-pace"><?= te('course.pace') ?></span></p>
<h2 id="course-title"><?= te('course.title') ?></h2>
<p class="product-description"><?= te('course.description') ?></p>
<?php render('partials/product-offer', ['launchKey' => 'course.launch', 'price' => $courseStartingPrice, 'termsKey' => 'course.terms']); ?>
<details class="product-details" id="course-interest"<?= $errorKey || !empty($courseForm['ok']) ? ' open' : '' ?>>
<summary><?= te('course.details') ?> <?= icon('chevron-right', 16, 2.2) ?></summary>
<div class="product-details-body">
<h3 class="course-pricing-title" id="course-pricing-title"><?= te('course.pricing') ?></h3>
<dl class="course-pricing" aria-labelledby="course-pricing-title">
<div><dt><?= te('course.small_team') ?></dt><dd><?= e($courseStartingPrice) ?></dd></div>
<div><dt><?= te('course.large_team') ?></dt><dd>US$1,999</dd></div>
<div><dt><?= te('course.enterprise') ?></dt><dd><?= te('course.enterprise_price') ?></dd></div>
</dl>

<div class="course-interest">
<div>
<h3><?= te('course.interest_title') ?></h3>
<p><?= te('course.interest_description') ?></p>
</div>
<?php if (!empty($courseForm['ok'])): ?>
<p class="form-success" role="status"><?= icon('check-circle', 20) ?> <?= te('course.success') ?></p>
<?php else: ?>
<form method="post" action="<?= e(url('products')) ?>#course-interest" class="contact-form" data-sending="<?= te('contact.sending') ?>">
<input type="hidden" name="product_form" value="course">
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<div class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
<label for="course-email"><?= te('course.email') ?>
<input id="course-email" type="email" name="email" maxlength="254" autocomplete="email" required aria-describedby="course-email-use<?= $errorKey ? ' course-error' : '' ?>"<?= $errorKey === 'course.error_email' ? ' aria-invalid="true"' : '' ?> value="<?= e($courseForm['old']['email'] ?? '') ?>">
</label>
<p class="course-privacy" id="course-email-use"><?= te('course.email_use') ?> <a href="<?= e(url('privacy')) ?>"><?= te('nav.privacy') ?></a></p>
<?php if ($errorKey): ?><p class="form-error" id="course-error" role="alert"><?= te($errorKey) ?></p><?php endif; ?>
<button class="pill" type="submit"><?= te('course.submit') ?></button>
</form>
<?php endif; ?>
</div>
</div>
</details>
</div>
</article>
</li>
<li><?php render('partials/agent-product', ['form' => ($form['kind'] ?? null) === 'agent' ? $form : []]); ?></li>
</ul>
</section>
