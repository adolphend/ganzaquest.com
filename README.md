# ganzaquest.com

Website of **GanzaQuest, a branch of NCIATA Ltd, a technology company registered in Rwanda**. Plain PHP and HTML: no database, no build step, runs on Hostinger Premium Web Hosting.

Languages: English (fallback, at `/`), Spanish (`/es`), French (`/fr`), German (`/de`), Dutch (`/nl`). The homepage follows the browser language when supported and remembers a manual selection.

## Before going live

Set the following keys in a hosting-only `app/config.local.php` that returns a PHP array. It is ignored by Git and overrides the corresponding values in `app/config.php`:

- `contact_to`: the email address that receives contact-form messages.
- `contact_from`: an active sender address on your domain.

The cybersecurity course interest and custom AI agent request forms use the same sender and recipient as the contact form. The course collects an email address for launch follow-up; the agent form collects project details for a reply. Neither form takes payment.

Then fill in the placeholders on the privacy page, in every file in `app/lang/` (search for `[`):
RDB registration number, registered address and contact email.

## Where things are

| What | File |
|---|---|
| All texts, per language | `app/lang/es.php`, `en.php`, `fr.php`, `de.php`, `nl.php` |
| Settings and page addresses (slugs) | `app/config.php` |
| Page layouts | `app/views/pages/` |
| Header, footer and shared blocks | `app/views/partials/` |
| Styles | `assets/css/site.css` |
| Mobile menu script | `assets/js/site.js` |
| Contact form logic | `app/contact.php` |
| Web server rules (clean URLs, security) | `.htaccess` |

To change a text, edit the same key in each language file. To add a page, add its slug to every language in `app/config.php`, its texts to each language file, and a view in `app/views/pages/`.

## Deploy on Hostinger

**Option A: from GitHub (updates automatically).**
hPanel → Websites → ganzaquest.com → Dashboard → Advanced → Git → connect GitHub, choose this repository and branch, and deploy into `public_html`.

**Option B: upload files.**
hPanel → File Manager → `public_html` → upload every file and folder of this repository (including the hidden `.htaccess` files).

The `app/` folder is blocked from the web by `.htaccess`. `app/storage/` must be writable (it holds the contact-form rate limit and the error log).

## Test locally

```sh
php -S localhost:8080 app/dev-router.php
```

Then open http://localhost:8080. (The local server ignores `.htaccess`; emails are not sent locally.)

## Security notes

- Only `index.php` runs; other PHP files and private folders return 404.
- No `X-Powered-By` header, no `.php` in addresses, neutral session cookie name, errors logged privately in `app/storage/error.log`.
- The contact form uses a CSRF token, a honeypot field and a per-visitor hourly limit. Messages are emailed, not stored.
- Keep PHP up to date in hPanel → Advanced → PHP Configuration (8.1 or newer, with `mbstring` enabled).

## Search engines and AI assistants

- `robots.txt` welcomes Google, Bing and AI assistants (ChatGPT, Claude, Perplexity, Gemini) and points to the sitemap.
- `sitemap.xml` lists every page in all five languages with `hreflang` links.
- `llms.txt` is a short plain-text summary of the company for AI tools.
- Every page has structured data (schema.org): Organization (NCIATA Ltd, with GanzaQuest as a branch), WebSite on the home page and FAQPage on the services page.
- Page titles and descriptions per language: `seo_titles` and `meta` in `app/lang/*.php`. FAQ texts: `faq` in the same files.

After the site is live:

1. **Google Search Console** (search.google.com/search-console): Add property → Domain → `ganzaquest.com` → copy the TXT record → hPanel → Domains → DNS / Nameservers → add a TXT record → Verify. Then Sitemaps → submit `sitemap.xml`.
2. **Bing Webmaster Tools** (bing.com/webmasters): sign in → Import from Google Search Console. Bing also feeds ChatGPT search and Copilot.
3. If you prefer the HTML-tag method instead of DNS, paste the codes into `google_site_verification` / `bing_site_verification` in `app/config.php`.


## SuspensionLab article

The case study is linked from the blog in English, Spanish, French, German and Dutch. The original English article is at `/blog/what-would-you-ask-it-to-do`; translated routes are configured in `app/config.php`. English content remains in `app/views/pages/suspension-story.php`; translated copy and metadata live in `app/lang/suspension-story/` and share `app/views/partials/suspension-translation.php`. The conceptual diagram is translated, and the saved experiment plot retains its original English labels with an explanatory caption. Native details elements provide reader choices without requiring JavaScript.

Editorial review covered five passes: narrative structure, plain-language explanations, relevance to simulation engineers, evidence and numerical claims, and final tone/reading flow. The article distinguishes supplied execution records from independent verification and includes the longer settling time and rough-road trade-offs.

Validation on 2026-11-21 used a portable official PHP 8.4.28 runtime, with its download checked against the publisher's SHA-256. All 34 PHP files passed syntax checks. Local HTTP checks passed for the article, canonical URL, BlogPosting data, language links, English blog listing, existing door story, four translated blog pages, homepage, sitemap, and new assets. Reported improvements and physical limits were checked against the published evidence extract. Browser visual QA and live hosting deployment were not verified by these checks. The original MATLAB simulations were not rerun.
