# ganzaquest.com

Website of **GanzaQuest, a brand of NCIATA Ltd**. Plain PHP and HTML: no database, no build step, runs on Hostinger Premium Web Hosting.

Languages: Spanish (default, at `/`), English (`/en`), French (`/fr`), German (`/de`), Dutch (`/nl`).

## Before going live

Open `app/config.php` and set:

- `contact_to`: the email address that receives contact-form messages.
- `contact_from`: a sender address on your domain, e.g. `no-reply@ganzaquest.com` (create it in hPanel → Emails).

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
- Keep PHP up to date in hPanel → Advanced → PHP Configuration (8.1 or newer).
