<?php /** @var string $launchKey @var string $price @var string $termsKey */ ?>
<div class="product-offer">
<p class="product-launch"><?= te($launchKey) ?></p>
<p class="product-price"><?= te('product_starting_at') ?> <strong><?= e($price) ?></strong></p>
</div>
<p class="product-terms"><?= icon('check-circle', 16) ?> <span><?= te($termsKey) ?></span></p>
