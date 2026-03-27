# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Development (watch mode)
npm start

# Production build
npm run build

# Deploy to staging / live
npm run deploy:staging
npm run deploy:live

# Package theme as zip (outputs codelibry.zip one level up)
npm run zip
```

Deployment requires a `.env` file based on `.env.example` with `STAGING_FTP_*` and `LIVE_FTP_*` credentials.

Before deploying, run `npm run build` — the deploy script sends the `dist/` folder as-is.

## Architecture

### PHP loading order (`functions.php`)
`inc/acf.php` → `inc/helpers.php` → `inc/shortcodes.php` → `inc/ajax.php` → `inc/post-types.php` → `inc/taxonomies.php` → `inc/theme-hooks.php`

Each of these loaders uses `glob()` to auto-require all `.php` files from their respective subdirectory, so dropping a new file into the right folder is sufficient — no manual registration needed.

### ACF field groups (`inc/acf/`)

Uses [`flyntwp/acf-field-group-composer`](https://github.com/flyntwp/acf-field-group-composer) (Composer). Field keys are **auto-generated** — never add `key` manually.

Structure:
- `inc/acf/blocks/` — pure PHP functions (`codelibry_acf_fields_*(): array`) that return field arrays with no registration. These are the single source of truth for each block's fields.
- `inc/acf/templates/` — field group registrations for page templates. `page-blocks.php` registers a `flexible_content` field (`page_blocks`) for the default page template, calling the block functions for each layout's `sub_fields`.
- `inc/acf/post-types/` — field group registrations scoped to specific post types (testimonials, reusable-blocks).

**Key uniqueness**: `page-blocks.php` uses field name `page_blocks`; `reusable-blocks.php` uses `reusable_blocks`. This ensures ACFComposer generates unique keys across both groups even though they share the same block functions.

### Page rendering (`page.php`)

`get_field('page-blocks')` returns the flexible content rows. Each row's `acf_fc_layout` name is used as the template slug and loaded from `template-parts/blocks/`. The block data array is passed directly as `$args`.

### Block templates (`template-parts/blocks/`)

Each block template reads its fields at the top using `get_array_value($args, 'field-name', get('field-name'))`. This works for both contexts — when `$args` is populated (called from `page.php` or `reusable-block.php`) and when it is empty (rendered standalone via `get_field()`).

Images are passed as attachment IDs (`return_format => 'id'`). Templates check `is_numeric($image)` to decide between `wp_get_attachment_image()` and a plain `<img>` tag.

### Reusable Blocks post type

The `reusable-blocks` CPT lets editors build a reusable set of blocks. On any regular page, the `reusable_block` flexible content layout contains a `post_object` field. At render time, `template-parts/sections/reusable-block.php` fetches `get_field('reusable_blocks', $post_id)` from the selected post and renders its blocks using the same section template loop.

### Assets

Static assets live in `assets/` (theme root) — **not** inside `src/`. SCSS `url()` paths must be relative to the final CSS output at `dist/css/main.min.css`, so they use `../../assets/...`. `css-loader` is configured with `url: false` so webpack does not attempt to process or copy these references.

Built output goes to `dist/` (`dist/main.min.js`, `dist/css/main.min.css`).

### Custom post types

- **`testimonials`** — public, supports title only; ACF fields: `author-name`, `author-position`, `content` (wysiwyg)
- **`reusable-blocks`** — private (admin-only), supports title only; ACF field: `reusable_blocks` flexible content

### Adding a new block

1. Create `inc/acf/blocks/my-block.php` with a `codelibry_acf_fields_my_block(): array` function
2. Add a layout entry to `inc/acf/templates/page-blocks.php` (and `inc/acf/post-types/reusable-blocks.php` if needed) calling the function
3. Create `template-parts/blocks/my-block.php` reading fields via `get_array_value($args, 'field-name', get('field-name'))`

### Adding a new page template

1. Create `page-templates/template-name.php` with `/* Template Name: ... */` header
2. Optionally create `inc/acf/templates/template-name.php` for template-specific ACF fields (auto-loaded)
