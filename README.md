# Bagbari Reunion Child — স্মৃতির আঙিনায় '২৬

A custom WordPress child theme for the **Bagbari Kalim Mahmud High School Reunion 2026** website, built on top of [GeneratePress](https://generatepress.com/). Dark royal + gold design system with Tailwind CSS, GSAP motion, and a dedicated registration experience.

> 📅 Event: 25 December 2026 (Friday), 9:00 AM — School Campus, Bagbari, Gabtoli, Bogura

## ✨ Features

- **Cinematic Bengali hero** — full-screen responsive hero (`hero-desktop.webp` / `hero-mobile.webp`), staggered line-reveal, CTAs, event pills, pinned date card
- **Live countdown** — Bengali-numeral countdown to registration deadline (filterable via `brc_countdown_target`)
- **Story / About section** — polaroid imagery, pull-quote, scroll-reveal animations
- **Event timeline** — alternating day schedule (9 AM → 10 PM) with GSAP ScrollTrigger reveals
- **Memory gallery** — polaroid-style photo grid with hover motion
- **Sponsors wall** — 12-logo grid + sponsor CTA (`sponsor@bagbari-reunion.com`)
- **Alumni pass card** — ticket-style pricing card (৳1,000/pass, ৳500/guest) with perforation, seal, barcode
- **Registration system** — dedicated `Register Page` template + portable `[reunion_form]` shortcode (`template-parts/reunion-form.php`)
- **Global chrome** — fixed header with scroll progress bar, mobile menu, rich animated footer (contact pills, social links, back-to-top)
- **Design system** — Tailwind (CDN) extended palette (`ink`, `maroon`, `gold`, `emerald`, `paper`), Tiro Bangla + Hind Siliguri fonts, grain/glow utilities in `assets/css/theme.css`
- **Motion** — GSAP 3.12.5 + ScrollTrigger via CDN, orchestrated in `assets/js/theme.js`
- **i18n ready** — `bagbari-reunion-sejan` text domain, `/languages` path

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| Parent theme | GeneratePress |
| Styling | Tailwind CSS (CDN config in `header.php`), `assets/css/theme.css` |
| Motion | GSAP 3.12.5 + ScrollTrigger (CDN) |
| Fonts | Tiro Bangla, Hind Siliguri (Google Fonts) |
| Scripts | `assets/js/theme.js`, `assets/js/reunion-form.js` |
| Requirements | WordPress 6.0+, PHP 7.4+, GeneratePress installed |

## 📁 Project Structure

```
bagbari-reunion-child/
├── style.css               # Theme header + GeneratePress child declaration
├── functions.php           # Setup, asset enqueue, shortcode, menu filters, helpers
├── header.php              # Global header, Tailwind config, nav, mobile menu
├── footer.php              # Global footer, contact, social, copyright
├── front-page.php          # Static homepage: hero, countdown, about, schedule, gallery, sponsors, pricing
├── page-register.php       # Register page template (renders [reunion_form])
├── template-parts/
│   └── reunion-form.php    # Registration form markup
├── assets/
│   ├── css/theme.css       # Design system, components, animations
│   ├── js/theme.js         # Hero, countdown, scroll reveals, nav, footer fx
│   ├── js/reunion-form.js  # Registration form logic
│   ├── hero-desktop.webp / hero-mobile.webp
│   ├── campus.webp, classroom.webp, football.webp, friends.webp, ...
│   └── logo1.jpg … logo12.jpg, logo10.png
└── README.md
```

## 🚀 Installation

1. Install and activate the **GeneratePress** parent theme.
2. Copy this folder to `wp-content/themes/bagbari-reunion-child/`.
3. In **Appearance → Themes**, activate **Bagbari Reunion Child**.
4. In **Settings → Reading**, set the homepage to a static page using the `Front Page` rendering (or assign `front-page.php` as the site front page).
5. Create a page with slug `register` using the **Register Page** template.

## 🧩 Setup Checklist

- **Menus** — Create a menu assigned to the `Primary Menu` location (falls back to a hardcoded Bengali nav if empty).
- **Homepage** — Assign a static front page so `front-page.php` renders.
- **Register page** — Page slug `register` + Template `Register Page`. The helper `brc_get_register_url()` auto-resolves it, falling back to `/register/`.
- **Countdown target** — Default `2026-11-25T09:00:00+06:00`. Override with:
  ```php
  add_filter( 'brc_countdown_target', fn() => '2026-12-20T09:00:00+06:00' );
  ```
- **Reusable form** — Drop `[reunion_form]` into any page/post; assets load on demand via `brc_enqueue_reunion_form_assets()`.

## 🎨 Customization

- **Colors / fonts** — Edit the `tailwind.config` block in `header.php` and variables in `assets/css/theme.css`.
- **Schedule / sponsors / pricing** — Edit the sections directly in `front-page.php` (sponsors array, timeline items, pass price).
- **Motion** — Tweak triggers in `assets/js/theme.js` (hero intro, `.reveal-up`, `#timeline`, sponsor stagger).
- **Menu link style** — Filtered in `brc_primary_menu_link_attributes()` (`functions.php`).

## 📄 Templates

| File | Purpose |
|---|---|
| `front-page.php` | Full homepage experience (7 sections) |
| `page-register.php` | Centered header + `[reunion_form]` output |
| `template-parts/reunion-form.php` | Standalone registration form partial |
| `header.php` / `footer.php` | Site-wide chrome (progress bar, nav, footer) |

## 👤 Author

Developed by **Sejan** — [facebook.com/sejan.kp](https://www.facebook.com/sejan.kp/)

## 📜 License

GNU General Public License v2 or later — see [http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html).
