# colemarshall.net

Personal site and interactive resume of **Cole Marshall** — Web Designer & Developer.

![CM Monogram](./images/cm_wireframe.svg)

## Stack

Deliberately simple and dependency-light:

- **PHP 8.1+** for templating — no framework
- **[JSON Resume](https://jsonresume.org/)** (`data/resume.json`) as the single source of truth for all content
- **Modern native CSS** (`style/main.css`) — design tokens via custom properties, `light-dark()` theming, fluid `clamp()` type, native nesting. No preprocessor, no build step.
- **Vanilla JavaScript** (`scripts/`)
- **[Parsedown](https://parsedown.org/)** (vendored via Composer) for Markdown in resume content

All third-party assets are self-hosted — no CDN requests at runtime except Google Analytics:

| Asset | Source | License |
| --- | --- | --- |
| `scripts/vendor/highlight.min.js` (+ `http.min.js`) | [highlight.js](https://highlightjs.org/) 11.11.1 | BSD-3-Clause |
| `style/fonts/*.woff2` | [Oswald](https://fonts.google.com/specimen/Oswald), [Catamaran](https://fonts.google.com/specimen/Catamaran), [Cousine](https://fonts.google.com/specimen/Cousine) (latin subsets) | OFL / Apache-2.0 (Cousine) |
| `style/icons/*.svg` | [Tabler Icons](https://tabler.io/icons) (plus `brand-500px`, `brand-artstation` from [Simple Icons](https://simpleicons.org/)) | MIT / CC0 |

## Structure

```
index.php               Home: hero, profiles, code samples
resume.php              Interactive resume: toggle sections, print, JSON
includes/
  config.php            All site-wide configuration and tunable values
  functions.php         Shared helpers (data loading, escaping, icons, schema)
  head.php              Shared <head>: meta, OpenGraph, JSON-LD, analytics
  codeSampleItems.php   Code sample definitions for the Knowledge section
data/
  resume.json           JSON Resume — edit this to update site content
  code/                 Source files for the Knowledge samples
style/                  main.css, cole-neon.css (code theme), fonts, icons
scripts/                home.js, resume.js, vendored highlight.js
```

## Development

Serve the site root with PHP's built-in server:

```
php -S localhost:8080
```

When deploying changed CSS/JS, bump `ASSET_VERSION` in `includes/config.php` to bust browser caches. Update `sitemap.xml` lastmod dates when content changes.
