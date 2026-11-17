# Task: Rebrand GanzaQuest as a product of NCIATA Ltd and make the site multilingual

You are editing the website for **GanzaQuest** (https://ganzaquest.com). The site is currently in **Spanish** only.

Two goals:
1. GanzaQuest is no longer a company of its own. It is now a **brand/product owned by NCIATA Ltd**,
   a company registered in Rwanda. Update the site to reflect this.
2. Make the site available in **5 languages**: Spanish (es), English (en), French (fr), German (de) and Dutch (nl).

Work in this order: first do the rebrand in Spanish (Part A), then add the languages (Part B), then run the final check (Part C).

---

## General rules

- Keep the brand name **GanzaQuest** everywhere it is used as a brand or product name. Never translate it.
- Never translate **NCIATA Ltd** or the name **Annonciate Mukamugema**.
- Remove every mention of **"Ganza Quest Ltd"** (and variants like "GanzaQuest Ltd", "Ganza Quest Limited").
  The only registered company is **NCIATA Ltd**.
- Do not change the design, layout, colors or images unless a step below says so.
- Before editing, explore the project: identify the framework or stack (plain HTML, React, Next.js, Astro, etc.),
  how pages and navigation are built, and whether there is a build step. Briefly report what you find before changing anything.

---

## Part A: Rebrand (Spanish)

Search the whole project for: `Ganza Quest Ltd`, `GanzaQuest Ltd`, `Ltd`, `Limited`, `©`, `copyright`,
`derechos reservados`. List every file and line you find, then edit them.

### A1. Company name mentions
Replace every "Ganza Quest Ltd" (or variant) with:

> GanzaQuest, una marca de NCIATA Ltd

### A2. Footer (all pages)
Replace the copyright line with:

> © 2026 NCIATA Ltd. Todos los derechos reservados. GanzaQuest es una marca de NCIATA Ltd.

If the year is generated automatically, keep it automatic and only change the company text.

### A3. "Sobre nosotros" page
Add this section near the top of the page, without removing existing content:

**Heading:** Nuestra historia

> GanzaQuest es una marca de NCIATA Ltd, empresa tecnológica registrada en Ruanda.
> NCIATA lleva el nombre de Annonciate Mukamugema, madre de nuestro fundador.
> Bajo NCIATA nace GanzaQuest: "Ganza" significa prevalecer y "Quest" representa la exploración y el progreso.
> Tecnología con propósito.

If the page already explains the meaning of "Ganza" and "Quest", merge the texts so the explanation appears only once.

### A4. Privacy page ("Privacidad")
- Set the data controller ("responsable del tratamiento") to **NCIATA Ltd**.
- Add these placeholders, exactly as written, so the owner can fill them in later:
  - Número de registro: `[NÚMERO DE REGISTRO RDB]`
  - Dirección: `[DIRECCIÓN REGISTRADA]`
  - Correo de contacto: `[CORREO DE CONTACTO]`
- Wherever the policy names the company, use "NCIATA Ltd (GanzaQuest)".

### A5. Metadata
- In `<title>` tags and meta descriptions, keep "GanzaQuest" as the brand.
- If there is structured data (JSON-LD `Organization`), set `"legalName": "NCIATA Ltd"` and keep `"name": "GanzaQuest"`.
- If `author` or `publisher` says "Ganza Quest Ltd", change it to "NCIATA Ltd". Set `og:site_name` to "GanzaQuest".

---

## Part B: Multilingual site (es, en, fr, de, nl)

### B1. URL structure
- **Spanish stays the default language at the current URLs** (e.g. `/`, `/servicios`, `/contacto`).
  Do not move or break existing Spanish URLs.
- Add the other languages under a prefix:
  - English: `/en/` (e.g. `/en/services`)
  - French: `/fr/` (e.g. `/fr/services`)
  - German: `/de/` (e.g. `/de/leistungen`)
  - Dutch: `/nl/` (e.g. `/nl/diensten`)
- Translate the URL slugs into each language where it is simple to do so. If the framework makes this hard,
  keep the Spanish slugs under each prefix (e.g. `/en/servicios`) and tell me.

### B2. How to implement
- Use the standard internationalization approach for the stack you found (for example built-in i18n routing
  in Next.js or Astro, or a translation library). For a plain HTML site, create a copy of each page per language
  in its own folder.
- Store translatable text in **one translation file per language** (e.g. `locales/es.json`, `locales/en.json`, …)
  if the stack supports it, so the owner can edit translations later without touching the code.
- Every page must exist in all 5 languages: Inicio, Sobre nosotros, Servicios, Productos, Blog, Contacto, Privacidad.
- Blog: translate the blog interface (titles, buttons, labels). Translate existing blog posts too.
  If there are more than 10 posts, translate the interface only, and list the posts that still need translating.

### B3. Language switcher
- Add a language switcher to the header on every page, showing: **ES · EN · FR · DE · NL**.
- Switching language must keep the user on the **same page** in the other language (not send them to the home page).
- Highlight the current language. Make the switcher work on mobile too.
- **Do not** redirect visitors automatically based on their browser language.

### B4. SEO for multiple languages
- Set the correct `<html lang="…">` on every page (`es`, `en`, `fr`, `de`, `nl`).
- Add `hreflang` links on every page pointing to all 5 versions, plus `x-default` pointing to the Spanish version.
- Translate `<title>` tags and meta descriptions.
- If there is a `sitemap.xml`, include all language versions.

### B5. Translation quality
- Translate the meaning naturally for each language; do not translate word for word.
- Use a professional, warm tone. In German use **"Sie"**; in French use **"vous"**; in Dutch use **"u"**
  for formal text, or **"je"** only if the Spanish uses "tú" throughout. Be consistent within each language.
- Use these approved texts **exactly** for the fixed elements:

#### Tagline
| Lang | Text |
|---|---|
| es | Tecnología con propósito |
| en | Technology with purpose |
| fr | Une technologie qui a du sens |
| de | Technologie mit Sinn |
| nl | Technologie met een doel |

#### Brand line (replaces "Ganza Quest Ltd")
| Lang | Text |
|---|---|
| es | GanzaQuest, una marca de NCIATA Ltd |
| en | GanzaQuest, a brand of NCIATA Ltd |
| fr | GanzaQuest, une marque de NCIATA Ltd |
| de | GanzaQuest, eine Marke der NCIATA Ltd |
| nl | GanzaQuest, een merk van NCIATA Ltd |

#### Footer
| Lang | Text |
|---|---|
| es | © 2026 NCIATA Ltd. Todos los derechos reservados. GanzaQuest es una marca de NCIATA Ltd. |
| en | © 2026 NCIATA Ltd. All rights reserved. GanzaQuest is a brand of NCIATA Ltd. |
| fr | © 2026 NCIATA Ltd. Tous droits réservés. GanzaQuest est une marque de NCIATA Ltd. |
| de | © 2026 NCIATA Ltd. Alle Rechte vorbehalten. GanzaQuest ist eine Marke der NCIATA Ltd. |
| nl | © 2026 NCIATA Ltd. Alle rechten voorbehouden. GanzaQuest is een merk van NCIATA Ltd. |

#### "Our story" section (About page)

**es — Nuestra historia**
> GanzaQuest es una marca de NCIATA Ltd, empresa tecnológica registrada en Ruanda.
> NCIATA lleva el nombre de Annonciate Mukamugema, madre de nuestro fundador.
> Bajo NCIATA nace GanzaQuest: "Ganza" significa prevalecer y "Quest" representa la exploración y el progreso.
> Tecnología con propósito.

**en — Our story**
> GanzaQuest is a brand of NCIATA Ltd, a technology company registered in Rwanda.
> NCIATA is named after Annonciate Mukamugema, our founder's mother.
> GanzaQuest was born within NCIATA: "Ganza" means to prevail, and "Quest" stands for exploration and progress.
> Technology with purpose.

**fr — Notre histoire**
> GanzaQuest est une marque de NCIATA Ltd, une entreprise technologique enregistrée au Rwanda.
> NCIATA porte le nom d'Annonciate Mukamugema, la mère de notre fondateur.
> GanzaQuest est née au sein de NCIATA : « Ganza » signifie l'emporter, et « Quest » représente l'exploration et le progrès.
> Une technologie qui a du sens.

**de — Unsere Geschichte**
> GanzaQuest ist eine Marke der NCIATA Ltd, eines in Ruanda eingetragenen Technologieunternehmens.
> NCIATA ist nach Annonciate Mukamugema benannt, der Mutter unseres Gründers.
> GanzaQuest ist innerhalb von NCIATA entstanden: „Ganza" bedeutet sich durchsetzen, und „Quest" steht für Entdeckung und Fortschritt.
> Technologie mit Sinn.

**nl — Ons verhaal**
> GanzaQuest is een merk van NCIATA Ltd, een technologiebedrijf geregistreerd in Rwanda.
> NCIATA is vernoemd naar Annonciate Mukamugema, de moeder van onze oprichter.
> GanzaQuest is ontstaan binnen NCIATA: 'Ganza' betekent zegevieren, en 'Quest' staat voor ontdekking en vooruitgang.
> Technologie met een doel.

#### Privacy page
- Translate the full privacy policy into each language.
- Keep the placeholders untranslated inside the brackets' meaning, but translate the labels:

| Lang | Registration number | Address | Contact email |
|---|---|---|---|
| es | Número de registro: `[NÚMERO DE REGISTRO RDB]` | Dirección: `[DIRECCIÓN REGISTRADA]` | Correo de contacto: `[CORREO DE CONTACTO]` |
| en | Registration number: `[RDB REGISTRATION NUMBER]` | Address: `[REGISTERED ADDRESS]` | Contact email: `[CONTACT EMAIL]` |
| fr | Numéro d'enregistrement : `[NUMÉRO D'ENREGISTREMENT RDB]` | Adresse : `[ADRESSE ENREGISTRÉE]` | E-mail de contact : `[E-MAIL DE CONTACT]` |
| de | Registernummer: `[RDB-REGISTERNUMMER]` | Anschrift: `[EINGETRAGENE ANSCHRIFT]` | Kontakt-E-Mail: `[KONTAKT-E-MAIL]` |
| nl | Registratienummer: `[RDB-REGISTRATIENUMMER]` | Adres: `[GEREGISTREERD ADRES]` | Contact-e-mail: `[CONTACT-E-MAIL]` |

- Add a short line at the top of each non-Spanish privacy page:
  - en: "This is a translation. In case of differences, the Spanish version prevails."
  - fr: « Ceci est une traduction. En cas de divergence, la version espagnole prévaut. »
  - de: „Dies ist eine Übersetzung. Im Zweifel gilt die spanische Fassung."
  - nl: "Dit is een vertaling. Bij verschillen is de Spaanse versie leidend."

#### Navigation labels
| es | en | fr | de | nl |
|---|---|---|---|---|
| Inicio | Home | Accueil | Startseite | Home |
| Sobre nosotros | About us | À propos | Über uns | Over ons |
| Servicios | Services | Services | Leistungen | Diensten |
| Productos | Products | Produits | Produkte | Producten |
| Blog | Blog | Blog | Blog | Blog |
| Contacto | Contact | Contact | Kontakt | Contact |
| Privacidad | Privacy | Confidentialité | Datenschutz | Privacy |

---

## Part C: Final check

1. Search the project for `Ganza Quest Ltd`, `GanzaQuest Ltd` and `Limited`. There must be **no results**.
2. Confirm "NCIATA Ltd" appears in the footer of every page, in every language, and on the About and Privacy pages.
3. Check that every page exists in all 5 languages and that the language switcher keeps the user on the same page.
4. Check that every page has the correct `lang` attribute and `hreflang` links.
5. Look for any text left untranslated (for example Spanish words on English pages) and fix it.
6. If the project has a build step (e.g. `npm run build`), run it and fix any errors.
7. Give me a short summary:
   - the stack you found and how you implemented the languages,
   - every file created or changed,
   - anything you could not do, or that I need to check by hand.
