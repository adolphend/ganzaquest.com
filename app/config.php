<?php
/**
 * Site settings. Edit the values below; nothing else needs to change.
 */
return [
    // Public address of the site, without a trailing slash.
    'site_url' => 'https://ganzaquest.com',

    // Where contact-form messages are sent. CHANGE THIS before going live.
    'contact_to' => 'CHANGE-ME@ganzaquest.com',

    // Sender address for contact-form emails. Use an address on your own domain
    // (create it in hPanel → Emails) so messages are not marked as spam.
    'contact_from' => 'no-reply@ganzaquest.com',

    // Maximum contact-form messages per visitor per hour.
    'contact_rate_limit' => 5,

    // Search engine verification codes (optional). Paste only the code from
    // Google Search Console ("HTML tag" method) and Bing Webmaster Tools ("Meta tag").
    // Leave empty if you verify through DNS or import Google into Bing instead.
    'google_site_verification' => '',
    'bing_site_verification' => '',

    // Image shown when a page is shared on social media.
    'social_image' => 'https://images.unsplash.com/photo-1675050757561-741bd739bc06?w=1344&h=768&fit=crop&q=80',

    // English uses the unprefixed URLs. Other languages use their language code.
    'default_lang' => 'en',
    'languages' => ['en', 'es', 'fr', 'de', 'nl'],

    // URL slug of every page, per language. '' is the home page.
    'slugs' => [
        'es' => ['door-story' => 'blog/abririas-la-puerta', 'home' => '', 'about' => 'sobre-nosotros', 'services' => 'servicios', 'products' => 'productos', 'blog' => 'blog', 'contact' => 'contacto', 'privacy' => 'privacidad'],
        'en' => ['door-story' => 'blog/would-you-open-the-door', 'home' => '', 'about' => 'about', 'services' => 'services', 'products' => 'products', 'blog' => 'blog', 'contact' => 'contact', 'privacy' => 'privacy'],
        'fr' => ['door-story' => 'blog/ouvririez-vous-la-porte', 'home' => '', 'about' => 'a-propos', 'services' => 'services', 'products' => 'produits', 'blog' => 'blog', 'contact' => 'contact', 'privacy' => 'confidentialite'],
        'de' => ['door-story' => 'blog/wuerdest-du-die-tuer-oeffnen', 'home' => '', 'about' => 'ueber-uns', 'services' => 'leistungen', 'products' => 'produkte', 'blog' => 'blog', 'contact' => 'kontakt', 'privacy' => 'datenschutz'],
        'nl' => ['door-story' => 'blog/zou-jij-de-deur-openen', 'home' => '', 'about' => 'over-ons', 'services' => 'diensten', 'products' => 'producten', 'blog' => 'blog', 'contact' => 'contact', 'privacy' => 'privacy'],
    ],

    // Order of the main navigation.
    'nav' => ['home', 'about', 'services', 'products', 'blog', 'contact'],
];
