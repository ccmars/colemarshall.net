# ColeMarshall.net

The personal site and interactive resume of **Cole Marshall** — Senior Full-Stack Engineer & Designer. Live at **[colemarshall.net](https://colemarshall.net)**.

![CM Monogram](./images/cm_wireframe.svg)

## Summary

This site is a working argument that the modern web platform is enough. Just current-spec HTML, CSS, JavaScript, and a little PHP:

- **One JSON file drives the whole site.** Every piece of content — the home page, the interactive resume, the JSON-LD structured data, the downloadable resume — renders from [`data/resume.json`](data/resume.json) ([JSON Resume](https://jsonresume.org/) format). Update the data and the site follows.
- **An interactive resume, not a PDF.** [colemarshall.net/resume.php](https://colemarshall.net/resume.php) lets you tailor exactly the sections you want to see, print the result, or take the raw JSON with you.
- **Modern native CSS with no preprocessor.** Design tokens as custom properties, `light-dark()` theming, `color-mix()`, native nesting, logical properties, fluid `clamp()` type. The entire design system is one readable file: [`style/main.css`](style/main.css).
- **Code samples that actually run.** The home page's Self-Portraits section is written as a running joke, but every sample is real, current-syntax code — PHP 8.5, modern JavaScript, native CSS — each with a "Run it" link that executes it.
- **Fast and accessible by default.** Semantic HTML, skip links, ARIA where it earns its keep, self-hosted variable fonts, and no runtime dependency heavier than highlight.js.

## Stack

Deliberately simple and dependency-light:

- **PHP 8+** for templating — no framework
- **[JSON Resume](https://jsonresume.org/)** (`data/resume.json`) as the single source of truth for all content
- **Modern native CSS** (`style/main.css`) — no preprocessor, no build step
- **Vanilla JavaScript** (`scripts/`)
- **[Parsedown](https://parsedown.org/)** (vendored) for Markdown in resume content

All third-party assets are self-hosted — the only runtime request that leaves the origin is Google Analytics:

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
  codeSampleItems.php   Code sample definitions for the Self-Portraits section
data/
  resume.json           JSON Resume — edit this to update site content
  code/                 Source files for the Self-Portraits samples
style/                  main.css, cole-neon.css (code theme), fonts, icons
scripts/                home.js, resume.js, vendored highlight.js
```

## Development

Serve the site root with PHP's built-in server:

```
php -S localhost:8080
```

When deploying changed CSS/JS, bump `ASSET_VERSION` in `includes/config.php` to bust browser caches. Update `sitemap.xml` lastmod dates when content changes.

## License

The [MIT license](LICENSE) covers the source code only — take whatever is useful, keep the notice. The content is not code: the resume data, copy, photography, and the CM monogram (`images/cm_wireframe.svg` and related artwork) are © Cole Marshall, all rights reserved.
