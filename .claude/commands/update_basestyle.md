Update `basestyle.php` to reflect the current state of all SCSS files.

## Steps

1. **Read all relevant SCSS source files:**
   - `src/scss/global/_root.scss` — CSS custom properties (colors, sizes, weights, line-heights, containers, radii, transitions, borders, shadows)
   - `src/scss/global/_typography.scss` — heading tags and utility classes
   - `src/scss/global/_breakpoints.scss` — breakpoint mixins and values
   - `src/scss/parts/_button.scss` — button variants and CSS variables
   - `src/scss/parts/_form.scss` — input, textarea, select, label styles
   - `src/scss/layout/_container.scss` — container variants
   - `src/scss/layout/_grid.scss` — grid and data-columns variants
   - `src/scss/layout/_cluster.scss`
   - `src/scss/layout/_repel.scss`
   - `src/scss/layout/_switcher.scss`
   - `src/scss/layout/_flow.scss`
   - `src/scss/layout/_box.scss`
   - `src/scss/layout/_section.scss`
   - `src/scss/utilities/_display.scss`
   - `src/scss/utilities/_visually-hidden.scss`

2. **Diff against what `basestyle.php` currently documents:**
   - New CSS variables added to `_root.scss` → add swatches/rows
   - Removed or renamed variables → remove or update entries
   - New button variants → add live examples
   - New layout primitives or utility classes → add demo sections
   - Changed values (e.g. breakpoint px, radius values) → update the displayed values
   - Removed classes → remove their sections

3. **Update `basestyle.php` in place:**
   - Keep the existing page structure and style
   - Only change what has actually diverged from the SCSS source
   - Every value shown on the page must come from the SCSS files — no hardcoding values that differ from the source
   - All live examples must use the real CSS classes (no mock wrappers or inline re-implementations)

## Rules
- Do not remove sections that still exist in SCSS
- Do not add sections for classes/variables that do not exist in SCSS
- Keep the page using `.section` + `.container` + `.flow` + `.box` for its own layout
- Values in tables and labels must match the SCSS source exactly
