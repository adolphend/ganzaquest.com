<?php
/** @var array $form */
$errors = [
    'expired' => 'contact.error_expired',
    'invalid' => 'agent.error_invalid',
    'rate' => 'contact.error_rate',
    'send' => 'agent.error_send',
];
$error = $errors[$form['error'] ?? ''] ?? null;
$old = $form['old'] ?? [];
?>
<article class="product-card" aria-labelledby="agent-title">
<div class="product-art product-art-agent" aria-hidden="true">
<span class="product-art-plate"><?= icon('workflow', 39, 1.5) ?></span>
</div>
<div class="product-content">
<p class="product-category"><?= te('agent.category') ?></p>
<h2 id="agent-title"><?= te('agent.title') ?></h2>
<p class="product-description"><?= te('agent.description') ?></p>
<?php render('partials/product-offer', ['launchKey' => 'agent.launch', 'price' => 'US$1,999', 'termsKey' => 'agent.payment']); ?>
<details class="product-details" id="agent-request"<?= $error || !empty($form['ok']) ? ' open' : '' ?>>
<summary><?= te('agent.details') ?> <?= icon('chevron-right', 16, 2.2) ?></summary>
<div class="product-details-body">
<p class="product-description"><?= te('agent.deployment') ?></p>
<div class="course-interest">
<h3><?= te('agent.form_title') ?></h3>
<p><?= te('agent.reply') ?></p>
<?php if (!empty($form['ok'])): ?>
<p class="form-success" role="status"><?= icon('check-circle', 20) ?> <?= te('agent.success') ?></p>
<?php else: ?>
<form method="post" action="<?= e(url('products')) ?>#agent-request" class="contact-form" data-sending="<?= te('contact.sending') ?>">
<input type="hidden" name="product_form" value="agent">
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<div class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
<?php if ($error): ?><p class="form-error" role="alert"><?= te($error) ?></p><?php endif; ?>
<label><?= te('course.email') ?>
<input name="email" type="email" maxlength="254" autocomplete="email" required value="<?= e($old['email'] ?? '') ?>">
</label>
<label><?= te('agent.use_case') ?>
<select name="use_case" required>
<option value=""><?= te('agent.choose') ?></option>
<?php foreach (AGENT_USE_CASES as $option): ?>
<option value="<?= e($option) ?>"<?= ($old['use_case'] ?? '') === $option ? ' selected' : '' ?>><?= te('agent.use_cases.' . $option) ?></option>
<?php endforeach; ?>
</select>
</label>
<label><?= te('agent.sector') ?>
<input type="text" name="sector" maxlength="100" required value="<?= e($old['sector'] ?? '') ?>">
</label>
<label><?= te('agent.hosting') ?>
<select name="hosting" required>
<?php foreach (AGENT_HOSTING_OPTIONS as $option): ?>
<option value="<?= e($option) ?>"<?= ($old['hosting'] ?? 'unsure') === $option ? ' selected' : '' ?>><?= te('agent.hosting_options.' . $option) ?></option>
<?php endforeach; ?>
</select>
</label>
<label><?= te('agent.model') ?> <span><?= te('contact.optional') ?></span>
<input type="text" name="model" maxlength="120" value="<?= e($old['model'] ?? '') ?>">
</label>
<label><?= te('agent.goal') ?> <span><?= te('contact.optional') ?></span>
<textarea name="goal" maxlength="600" rows="3"><?= e($old['goal'] ?? '') ?></textarea>
</label>
<p class="course-privacy"><?= te('agent.data_use') ?> <a href="<?= e(url('privacy')) ?>"><?= te('nav.privacy') ?></a></p>
<button class="pill" type="submit"><?= te('agent.submit') ?></button>
</form>
<?php endif; ?>
</div>
</div>
</details>
</div>
</article>
