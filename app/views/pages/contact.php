<?php
/** @var array $form */
$old = $form['old'] ?? [];
$errors = [
    'invalid' => 'contact.error_invalid',
    'rate' => 'contact.error_rate',
    'expired' => 'contact.error_expired',
    'send' => 'contact.error_send',
];
$value = static fn(string $key): string => e($old[$key] ?? '');
?>
<section class="contact-section section-rail">
<aside>
<p class="eyebrow dark-eyebrow"><?= te('contact.eyebrow') ?></p>
<h2><?= te('contact.title') ?></h2>
<p><?= te('contact.text') ?></p>
<div class="contact-detail"><?= icon('lock', 22) ?><div><strong><?= te('contact.private_title') ?></strong><p><?= te('contact.private_text') ?></p></div></div>
<p class="contact-footnote"><?= te('contact.footnote') ?></p>
</aside>
<form method="post" action="<?= e(url('contact')) ?>#formulario" class="contact-form" id="formulario" data-sending="<?= te('contact.sending') ?>">
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<div class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
<div class="form-row">
<label><?= te('contact.name') ?> *<input name="name" required maxlength="150" autocomplete="name" placeholder="<?= te('contact.name_ph') ?>" value="<?= $value('name') ?>"></label>
<label><?= te('contact.email') ?> *<input name="email" required type="email" maxlength="254" autocomplete="email" placeholder="<?= te('contact.email_ph') ?>" value="<?= $value('email') ?>"></label>
</div>
<label><?= te('contact.company') ?> <span><?= te('contact.optional') ?></span><input name="company" maxlength="200" autocomplete="organization" placeholder="<?= te('contact.company_ph') ?>" value="<?= $value('company') ?>"></label>
<label><?= te('contact.service') ?>
<select name="service">
<option value="general"><?= te('services.general') ?></option>
<?php foreach (t('services.items') as $service): ?>
<option value="<?= e($service['title']) ?>"<?= ($old['service'] ?? '') === $service['title'] ? ' selected' : '' ?>><?= e($service['title']) ?></option>
<?php endforeach; ?>
</select>
</label>
<label><?= te('contact.message') ?> *<textarea name="message" required minlength="10" maxlength="5000" rows="5" placeholder="<?= te('contact.message_ph') ?>"><?= $value('message') ?></textarea></label>
<label class="consent-label"><input type="checkbox" name="consent" value="true" required><span><?= te('contact.consent_before') ?> <a href="<?= e(url('privacy')) ?>"><?= te('contact.consent_link') ?></a> <?= te('contact.consent_after') ?> *</span></label>
<button class="button button-blue" type="submit"><?= te('contact.submit') ?> <?= icon('arrow-up-right', 19) ?></button>
<div aria-live="polite">
<?php if (!empty($form['ok'])): ?>
<p class="form-success"><?= icon('check-circle', 20) ?> <?= te('contact.success') ?></p>
<?php elseif (!empty($form['error']) && isset($errors[$form['error']])): ?>
<p class="form-error" role="alert"><?= te($errors[$form['error']]) ?></p>
<?php endif; ?>
</div>
</form>
</section>
