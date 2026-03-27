Create a new flexible content block for the theme. The block name is: $ARGUMENTS

## Steps

1. **Create ACF fields file** at `inc/acf/blocks/{block-name}.php`
   - Function name: `codelibry_acf_fields_{block_name_snake}(): array`
   - Return an array of ACF field definitions (no `key` properties — ACFComposer generates them)
   - Each key/value pair on its own line
   - For image fields use `'return_format' => 'id'` and `'preview_size' => 'medium'`
   - Use a `repeater` for lists of items

2. **Register the layout** in `inc/acf/templates/page-blocks.php`
   - Add a new entry to the `'layouts'` array inside `ACFComposer::registerFieldGroup()`
   - Format:
     ```php
     [
         'name'       => '{block-name}',
         'label'      => '{Block Label}',
         'display'    => 'block',
         'sub_fields' => codelibry_acf_fields_{block_name_snake}(),
     ],
     ```
   - Also add the same layout to `inc/acf/post-types/reusable-blocks.php`

3. **Create SCSS file** at `src/scss/blocks/_{block-name}.scss`
   - Use BEM naming: `.{block-name}__element`
   - Import it in `src/scss/main.scss` under the `/* Blocks */` section (create the section if it doesn't exist)
   - **Always maximise use of existing globals before writing custom CSS:**
     - **CSS variables** from `src/scss/global/_root.scss` — use these for all colors, font sizes, font weights, line heights, spacing, radii, transitions, borders, shadows: `var(--color-primary)`, `var(--size-h2)`, `var(--radius-md)`, `var(--transition-base)`, `var(--shadow-base)`, etc.
     - **Base styles** from `src/scss/global/_base.scss` — `body` already sets `font-size`, `font-family`, `font-weight`, `line-height`, and `color`; links, images, and focus states are globally handled. Do not re-declare these on block elements.
     - **Typography** — `h1`–`h6` and `.h1`–`.h6` already have correct size/weight/line-height applied globally; add heading classes to HTML elements instead of re-declaring font styles in SCSS. The `@mixin heading` is also available.
     - **Layout mixins** — prefer these over hand-rolled flex/grid when they fit:
       - `@include cluster` — flex row, wrapping, centered items, gap-controlled
       - `@include flow` / `@include flow-recursive` — vertical spacing between children via `--flow-space`
       - `@include repel` — space-between flex row
       - `@include switcher` — flex row that wraps to full-width below a breakpoint
       - `@include box` — padded card with border-radius and white background
     - **Layout classes** — use directly in HTML when appropriate: `.grid`, `.grid[data-columns='2|3|4']`, `.cluster`, `.flow`, `.repel`, `.switcher`, `.box`, `.container`, `.container-sm`, `.container-lg`, `.section`
     - **Breakpoint mixins** — `@include xl`, `@include lg`, `@include md`, `@include sm` from `_breakpoints.scss`
     - **Utility mixins** — `@include reset-button`, `@include image-cover`, `@include image-contain`
   - Only write custom CSS for styles that cannot be achieved with the above

4. **Create JS file** at `src/js/{block-name}.js` (if the block needs JS, e.g. Swiper, accordions)
   - Export a default function named in PascalCase: `export default function BlockName() {}`
   - Import Swiper modules explicitly: `import { Pagination, Autoplay } from 'swiper/modules'`
   - Never use inline `<script>` tags in templates — all JS goes through the module system
   - Import and call the function in `src/main.js` inside the `DOMContentLoaded` listener

5. **Create the block template** at `template-parts/blocks/{block-name}.php`
   - Read all fields at the top using `get_array_value($args, 'field-name', get('field-name'))` — this handles both `$args` (when called from page/reusable-block) and `get_field()` (when rendered standalone). No `if (isset($args['is_example']))` branching needed.
   - Example field reads:
     ```php
     $title    = get_array_value($args, 'block-name-title', get('block-name-title'));
     $subtitle = get_array_value($args, 'block-name-subtitle', get('block-name-subtitle'));
     $button   = get_array_value($args, 'block-name-button', get('block-name-button'));
     ```
   - Never use `$args['key'] ?? null` or `isset($args['key'])` directly — always use `get_array_value($args, 'key', get('key'))`
   - If the block has a title, subtitle, and/or button in the section header, render them via the shared section-header template part:
     ```php
     <?php get_template_part('template-parts/parts/section-header', null, [
         'title'    => $title,
         'subtitle' => $subtitle,
         'button'   => $button,
     ]); ?>
     ```
   - For image fields check `is_numeric($image)` and use `wp_get_attachment_image()` for IDs, `<img src="...">` for URLs
   - Wrap output in `<section class="{block-name} | section">` with `<div class="container">`
   - Guard required fields with early `return` or `if` checks

## Naming conventions
- File names use kebab-case: `my-block.php`
- ACF field names use kebab-case: `my-block-title`, `my-block-list`
- PHP function uses snake_case: `codelibry_acf_fields_my_block`
- Layout name in ACFComposer uses kebab-case: `my-block`
- CSS classes use kebab-case BEM: `my-block__title`
