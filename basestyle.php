<?php get_header(); ?>

<main>

  <!-- ===================== INTRO ===================== -->
  <section class="section">
    <div class="container flow" style="--flow-space: 1.5rem">
      <h1>Base Style</h1>
      <p>Live reference for all CSS primitives available in this theme. Every example uses the actual classes — no mocks.</p>
      <nav>
        <ol class="flow" style="--flow-space: 0.25rem; list-style: decimal; padding-left: 1.25rem">
          <li><a href="#colors">Colors</a></li>
          <li><a href="#typography">Typography</a></li>
          <li><a href="#buttons">Buttons</a></li>
          <li><a href="#forms">Forms</a></li>
          <li><a href="#layout">Layout Primitives</a></li>
          <li><a href="#utilities">Utilities</a></li>
          <li><a href="#effects">Spacing &amp; Effects</a></li>
        </ol>
      </nav>
    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 1. COLORS ===================== -->
  <section class="section" id="colors">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>1. Colors</h2>
      <p>All color tokens are defined as CSS custom properties on <code>:root</code> in <code>_root.scss</code>.</p>

      <div class="flow" style="--flow-space: 1.5rem">

        <h3>Brand</h3>
        <div class="grid" data-columns="4" style="--gap: 1rem">
          <?php
          $colors = [
            ['var', '--color-primary',   '#AE8F55', 'Accent — buttons, links, borders'],
            ['var', '--color-secondary', '#FFEECE', 'Secondary accent'],
            ['var', '--color-dark',      '#121212', 'Default text color'],
            ['var', '--color-light',     '#FFF7E9', 'Default background'],
            ['var', '--color-black',     '#000000', 'Pure black'],
            ['var', '--color-white',     '#FFFFFF', 'Pure white'],
          ];
          foreach ($colors as [$type, $name, $value, $desc]): ?>
            <div class="box flow" style="--flow-space: 0.5rem; padding: 0; overflow: hidden; background: var(--color-white)">
              <div style="height: 5rem; background: <?php echo $name === '--color-primary' ? 'var(--color-primary)' : "var($name)"; ?>; border-bottom: var(--stroke-base)"></div>
              <div style="padding: 0.75rem">
                <code style="font-size: var(--size-sm)"><?php echo esc_html($name); ?></code>
                <p style="font-size: var(--size-xs); opacity: 0.7; margin-top: 0.25rem"><?php echo esc_html($value); ?> — <?php echo esc_html($desc); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <h3>Feedback</h3>
        <div class="grid" data-columns="4" style="--gap: 1rem">
          <?php
          $feedback = [
            ['--color-success', 'green',  'Success states'],
            ['--color-warning', 'yellow', 'Warning states'],
            ['--color-error',   'red',    'Error states'],
          ];
          foreach ($feedback as [$name, $value, $desc]): ?>
            <div class="box flow" style="--flow-space: 0.5rem; padding: 0; overflow: hidden">
              <div style="height: 3rem; background: <?php echo esc_attr($value); ?>; border-bottom: var(--stroke-base)"></div>
              <div style="padding: 0.75rem">
                <code style="font-size: var(--size-sm)"><?php echo esc_html($name); ?></code>
                <p style="font-size: var(--size-xs); opacity: 0.7; margin-top: 0.25rem"><?php echo esc_html($desc); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 2. TYPOGRAPHY ===================== -->
  <section class="section" id="typography">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>2. Typography</h2>
      <p>All headings share <code>font-family: var(--font-primary)</code>, <code>font-weight: var(--font-bold)</code>, <code>line-height: var(--leading-flat)</code>. Use the tag or the utility class.</p>

      <div class="flow" style="--flow-space: 1.5rem">

        <h3>Heading Scale</h3>
        <div class="box flow" style="--flow-space: 1.25rem">
          <?php
          $headings = [
            ['h1', '--size-h1', 'clamp(3.375rem, 6vw, 4.5rem)', '54px → 72px'],
            ['h2', '--size-h2', 'clamp(2.5rem, 4.5vw, 3.375rem)', '40px → 54px'],
            ['h3', '--size-h3', 'clamp(2.125rem, 3.5vw, 2.5rem)', '34px → 40px'],
            ['h4', '--size-h4', 'clamp(1.375rem, 3vw, 2.125rem)', '22px → 34px'],
            ['h5', '--size-h5', '1.375rem', '22px'],
            ['h6', '--size-h6', '1.125rem', '18px'],
          ];
          foreach ($headings as [$tag, $var, $value, $range]): ?>
            <div class="repel" style="--gap: 1rem; flex-wrap: nowrap; align-items: baseline; border-bottom: var(--stroke-base); padding-bottom: 1rem">
              <<?php echo $tag; ?>>The quick brown fox<br>jumps over the lazy dog</<?php echo $tag; ?>>
              <div style="flex-shrink: 0; text-align: right">
                <code style="display: block; font-size: var(--size-sm)">&lt;<?php echo $tag; ?>&gt; / .<?php echo $tag; ?></code>
                <code style="display: block; font-size: var(--size-xs); opacity: 0.6"><?php echo esc_html($var); ?></code>
                <span style="font-size: var(--size-xs); opacity: 0.5"><?php echo esc_html($range); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <h3>Font Sizes</h3>
        <div class="box">
          <table style="width: 100%; border-collapse: collapse">
            <thead>
              <tr style="border-bottom: var(--stroke-base)">
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Variable</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Value</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Sample</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sizes = [
                ['--size-md', '1rem (16px)',       'The quick brown fox'],
                ['--size-sm', '0.875rem (14px)',   'The quick brown fox'],
                ['--size-xs', '0.75rem (12px)',    'The quick brown fox'],
              ];
              foreach ($sizes as [$var, $val, $sample]): ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.07)">
                  <td style="padding: 0.5rem 0.75rem"><code><?php echo esc_html($var); ?></code></td>
                  <td style="padding: 0.5rem 0.75rem; font-size: var(--size-sm); opacity: 0.6"><?php echo esc_html($val); ?></td>
                  <td style="padding: 0.5rem 0.75rem; font-size: var(<?php echo esc_attr($var); ?>)"><?php echo esc_html($sample); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <h3>Font Weights</h3>
        <div class="box">
          <table style="width: 100%; border-collapse: collapse">
            <thead>
              <tr style="border-bottom: var(--stroke-base)">
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Variable</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Value</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem; font-size: var(--size-sm)">Sample</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $weights = [
                ['--font-extra-bold', '700'],
                ['--font-bold',       '600'],
                ['--font-medium',     '500'],
                ['--font-regular',    '400'],
              ];
              foreach ($weights as [$var, $val]): ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.07)">
                  <td style="padding: 0.5rem 0.75rem"><code><?php echo esc_html($var); ?></code></td>
                  <td style="padding: 0.5rem 0.75rem; font-size: var(--size-sm); opacity: 0.6"><?php echo esc_html($val); ?></td>
                  <td style="padding: 0.5rem 0.75rem; font-weight: <?php echo esc_attr($val); ?>">The quick brown fox jumps over the lazy dog</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <h3>Line Heights</h3>
        <div class="grid" data-columns="4" style="--gap: 1rem">
          <?php
          $leadings = [
            ['--leading-flat',    '1',     'Headings'],
            ['--leading-normal',  '1.25',  'Default comfortable'],
            ['--leading-relaxed', '1.5',   'Body text'],
            ['--leading-loose',   '1.625', 'Airy / large blocks'],
          ];
          foreach ($leadings as [$var, $val, $desc]): ?>
            <div class="box">
              <p style="line-height: <?php echo esc_attr($val); ?>; margin-bottom: 0.75rem">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
              <code style="font-size: var(--size-sm); display: block"><?php echo esc_html($var); ?></code>
              <span style="font-size: var(--size-xs); opacity: 0.6"><?php echo esc_html($val); ?> — <?php echo esc_html($desc); ?></span>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 3. BUTTONS ===================== -->
  <section class="section" id="buttons">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>3. Buttons</h2>
      <p>Two variants. Customize per-instance via CSS variables on the element.</p>

      <div class="flow" style="--flow-space: 1.5rem">

        <div class="box flow" style="--flow-space: 1rem">
          <div class="cluster" style="--gap: 1rem">
            <a href="#buttons" class="button">.button</a>
            <a href="#buttons" class="button button--secondary">.button.button--secondary</a>
          </div>
          <div class="flow" style="--flow-space: 0.5rem">
            <p style="font-size: var(--size-sm)">Available CSS variables (set inline or in SCSS):</p>
            <div class="grid" data-columns="2" style="--gap: 0.5rem; font-size: var(--size-sm)">
              <code>--button-bg: var(--color-primary)</code>
              <code>--button-text: var(--color-white)</code>
              <code>--button-x-padding: 1.5rem</code>
              <code>--button-y-padding: 1rem</code>
              <code>--button-min-width: 4rem</code>
              <code>--button-gap: 0.5ch</code>
            </div>
          </div>
        </div>

        <div class="box">
          <p style="font-size: var(--size-sm); margin-bottom: 0.75rem">Custom color override via inline variable:</p>
          <a href="#buttons" class="button" style="--button-bg: var(--color-dark); --button-text: var(--color-light)">Custom color</a>
        </div>

      </div>
    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 4. FORMS ===================== -->
  <section class="section" id="forms">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>4. Forms</h2>
      <p>All inputs get base styles automatically — no extra classes needed. <code>accent-color</code> uses <code>--color-primary</code>.</p>

      <div class="box">
        <?php $fid = wp_generate_uuid4(); ?>
        <div class="grid" data-columns="2" style="--gap: 1.5rem">

          <div class="flow" style="--flow-space: 0.25rem">
            <label for="bs-text-<?php echo esc_attr($fid); ?>">Text input</label>
            <input type="text" id="bs-text-<?php echo esc_attr($fid); ?>" placeholder="Placeholder">
          </div>

          <div class="flow" style="--flow-space: 0.25rem">
            <label for="bs-email-<?php echo esc_attr($fid); ?>">Email input</label>
            <input type="email" id="bs-email-<?php echo esc_attr($fid); ?>" placeholder="you@example.com">
          </div>

          <div class="flow" style="--flow-space: 0.25rem">
            <label for="bs-select-<?php echo esc_attr($fid); ?>">Select</label>
            <select id="bs-select-<?php echo esc_attr($fid); ?>">
              <option>Option one</option>
              <option>Option two</option>
              <option>Option three</option>
            </select>
          </div>

          <div class="flow" style="--flow-space: 0.25rem">
            <label for="bs-search-<?php echo esc_attr($fid); ?>">Search</label>
            <input type="search" id="bs-search-<?php echo esc_attr($fid); ?>" placeholder="Search…">
          </div>

          <div class="flow" style="--flow-space: 0.25rem" style="grid-column: 1 / -1">
            <label for="bs-textarea-<?php echo esc_attr($fid); ?>">Textarea</label>
            <textarea id="bs-textarea-<?php echo esc_attr($fid); ?>" placeholder="Your message…"></textarea>
          </div>

        </div>

        <div class="cluster" style="--gap: 1.5rem; margin-top: 1.5rem">
          <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; margin-bottom: 0">
            <input type="checkbox"> Checkbox
          </label>
          <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; margin-bottom: 0">
            <input type="radio" name="bs-radio"> Radio A
          </label>
          <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; margin-bottom: 0">
            <input type="radio" name="bs-radio"> Radio B
          </label>
        </div>

        <div style="margin-top: 1.5rem">
          <input type="submit" value="Submit">
        </div>
      </div>
    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 5. LAYOUT PRIMITIVES ===================== -->
  <section class="section" id="layout">
    <div class="container flow" style="--flow-space: 3rem">
      <h2>5. Layout Primitives</h2>
      <p>Composable, single-responsibility layout classes. Control behaviour via CSS variables.</p>

      <!-- Container -->
      <div class="flow" style="--flow-space: 1rem" id="layout-container">
        <h3>.container / .container-sm / .container-lg</h3>
        <p style="font-size: var(--size-sm)">Centers content with 1rem side padding. Max-widths use tokens from <code>_root.scss</code>.</p>
        <div class="box flow" style="--flow-space: 0.5rem; background: var(--color-secondary)">
          <?php
          $containers = [
            ['container-sm', '--container-sm', '980px',  'Content pages, Privacy Policy'],
            ['container',    '--container-md', '1200px', 'Default — most sections'],
            ['container-lg', '--container-lg', '1300px', 'Header, Footer'],
          ];
          foreach ($containers as [$cls, $var, $px, $use]): ?>
            <div style="padding: 0.75rem 1rem; background: var(--color-primary); opacity: 0.8; border-radius: var(--radius-xs); color: var(--color-white)">
              <code style="font-size: var(--size-sm)">.<?php echo $cls; ?></code>
              <span style="font-size: var(--size-xs); margin-left: 0.75rem; opacity: 0.85"><?php echo esc_html($var); ?> = <?php echo esc_html($px); ?> — <?php echo esc_html($use); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Grid -->
      <div class="flow" style="--flow-space: 1rem" id="layout-grid">
        <h3>.grid</h3>
        <p style="font-size: var(--size-sm)">Responsive grid. Control gap via <code>--gap</code>. Use <code>data-columns</code> for fixed layouts.</p>
        <div class="flow" style="--flow-space: 1rem">
          <?php
          $grids = [
            [null,  'auto-fill',  '(no data-columns) — auto-fill, min 16rem per column'],
            ['2',   'auto-fit',   'data-columns="2" — 2 cols, breaks ≈ 500px'],
            ['3',   'auto-fit',   'data-columns="3" — 3 cols, breaks ≈ 768px'],
            ['4',   'fixed',      'data-columns="4" — 4 cols → 2 cols (500px) → 1 col'],
          ];
          foreach ($grids as [$cols, $mode, $desc]): ?>
            <div>
              <p style="font-size: var(--size-xs); opacity: 0.6; margin-bottom: 0.5rem"><?php echo esc_html($desc); ?></p>
              <div class="grid<?php echo $cols ? '' : ''; ?>" <?php echo $cols ? "data-columns=\"$cols\"" : ''; ?> style="--gap: 0.5rem">
                <?php for ($i = 1; $i <= ($cols ?? 3); $i++): ?>
                  <div style="padding: 1rem; background: var(--color-secondary); border-radius: var(--radius-xs); text-align: center; font-size: var(--size-sm)">Item <?php echo $i; ?></div>
                <?php endfor; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Cluster -->
      <div class="flow" style="--flow-space: 1rem" id="layout-cluster">
        <h3>.cluster</h3>
        <p style="font-size: var(--size-sm)">Flex row with wrap. Items flow naturally; gap controlled via <code>--gap</code>. Great for tags, button groups, nav items.</p>
        <div class="box">
          <div class="cluster" style="--gap: 0.5rem">
            <?php foreach (['Design', 'Development', 'Motion', 'Branding', 'Strategy', 'Photography', 'Copy'] as $tag): ?>
              <span style="padding: 0.25rem 0.75rem; background: var(--color-secondary); border-radius: var(--radius-xl); font-size: var(--size-sm)"><?php echo $tag; ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Repel -->
      <div class="flow" style="--flow-space: 1rem" id="layout-repel">
        <h3>.repel</h3>
        <p style="font-size: var(--size-sm)">Space-between flex row. Pushes two groups to opposite ends. Falls back gracefully on narrow screens.</p>
        <div class="box">
          <div class="repel">
            <strong>Left side</strong>
            <a href="#layout" class="button">Right side</a>
          </div>
        </div>
      </div>

      <!-- Switcher -->
      <div class="flow" style="--flow-space: 1rem" id="layout-switcher">
        <h3>.switcher</h3>
        <p style="font-size: var(--size-sm)">Two equal columns that collapse to stacked when the container is narrower than <code>--switcher-target-container-width</code> (default <code>40rem</code>). Max 2 items — third+ go full-width.</p>
        <div class="box">
          <div class="switcher" style="--gap: 1rem">
            <div style="padding: 1.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Column A</div>
            <div style="padding: 1.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Column B</div>
          </div>
          <p style="font-size: var(--size-xs); opacity: 0.6; margin-top: 0.75rem">Override breakpoint: <code style="font-size: var(--size-xs)">style="--switcher-target-container-width: 60rem"</code></p>
        </div>
      </div>

      <!-- Flow -->
      <div class="flow" style="--flow-space: 1rem" id="layout-flow">
        <h3>.flow / .flow-recursive</h3>
        <p style="font-size: var(--size-sm)"><code>.flow</code> adds <code>margin-top</code> to every direct child after the first. <code>.flow-recursive</code> does the same for all descendants. Control spacing via <code>--flow-space</code> (default <code>1rem</code>).</p>
        <div class="grid" data-columns="2" style="--gap: 1rem">
          <div class="box flow" style="--flow-space: 0.5rem">
            <p style="font-size: var(--size-xs); opacity: 0.6">.flow with --flow-space: 0.5rem</p>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 1</div>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 2</div>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 3</div>
          </div>
          <div class="box flow" style="--flow-space: 2rem">
            <p style="font-size: var(--size-xs); opacity: 0.6">.flow with --flow-space: 2rem</p>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 1</div>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 2</div>
            <div style="padding: 0.5rem; background: var(--color-secondary); border-radius: var(--radius-xs)">Item 3</div>
          </div>
        </div>
      </div>

      <!-- Box -->
      <div class="flow" style="--flow-space: 1rem" id="layout-box">
        <h3>.box</h3>
        <p style="font-size: var(--size-sm)">White card with 2rem padding and <code>--radius-md</code>. Padding reduces to 1.5rem on <code>≤390px</code>.</p>
        <div class="box">
          This is a <code>.box</code>. Combine with <code>.flow</code>, <code>.cluster</code>, etc. for complex cards.
        </div>
      </div>

      <!-- Section -->
      <div class="flow" style="--flow-space: 1rem" id="layout-section">
        <h3>.section / .section-top / .section-bottom</h3>
        <p style="font-size: var(--size-sm)">Adds 2.5rem vertical padding. This entire page uses <code>.section</code> per row.</p>
        <div class="box flow" style="--flow-space: 0.5rem">
          <code style="display: block">&lt;section class="section"&gt;</code>
          <code style="display: block; padding-left: 1rem">&lt;div class="container"&gt;...&lt;/div&gt;</code>
          <code style="display: block">&lt;/section&gt;</code>
        </div>
      </div>

    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 6. UTILITIES ===================== -->
  <section class="section" id="utilities">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>6. Utilities</h2>

      <!-- Visually Hidden -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>.visually-hidden</h3>
        <p style="font-size: var(--size-sm)">Hides content visually while keeping it accessible to screen readers. Never use <code>display: none</code> for accessible text.</p>
        <div class="box">
          <p>The button below has a visually hidden label:</p>
          <button class="button" style="--button-x-padding: 1rem">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
            <span class="visually-hidden">Open menu</span>
          </button>
          <code style="display: block; margin-top: 0.75rem; font-size: var(--size-sm)">&lt;span class="visually-hidden"&gt;Open menu&lt;/span&gt;</code>
        </div>
      </div>

      <!-- Display Utilities -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Display Utilities</h3>
        <p style="font-size: var(--size-sm)">All use <code>!important</code>. Breakpoint variants hide/show at specific max-widths.</p>
        <div class="box">
          <table style="width: 100%; border-collapse: collapse; font-size: var(--size-sm)">
            <thead>
              <tr style="border-bottom: var(--stroke-base)">
                <th style="text-align: left; padding: 0.5rem 0.75rem">Class</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem">Effect</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem">Breakpoint</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $displays = [
                ['.display-block',    'display: block',  'always'],
                ['.display-flex',     'display: flex',   'always'],
                ['.display-none',     'display: none',   'always'],
                ['.display-sm-block', 'display: block',  '≤ 390px'],
                ['.display-sm-none',  'display: none',   '≤ 390px'],
                ['.display-md-block', 'display: block',  '≤ 768px'],
                ['.display-md-none',  'display: none',   '≤ 768px'],
                ['.display-lg-block', 'display: block',  '≤ 991px'],
                ['.display-lg-none',  'display: none',   '≤ 991px'],
                ['.display-xl-block', 'display: block',  '≤ 1200px'],
                ['.display-xl-none',  'display: none',   '≤ 1200px'],
              ];
              foreach ($displays as [$cls, $effect, $bp]): ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.07)">
                  <td style="padding: 0.5rem 0.75rem"><code><?php echo esc_html($cls); ?></code></td>
                  <td style="padding: 0.5rem 0.75rem; opacity: 0.7"><?php echo esc_html($effect); ?></td>
                  <td style="padding: 0.5rem 0.75rem; opacity: 0.7"><?php echo esc_html($bp); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>

  <div class="container"><hr></div>

  <!-- ===================== 7. SPACING & EFFECTS ===================== -->
  <section class="section" id="effects">
    <div class="container flow" style="--flow-space: 2rem">
      <h2>7. Spacing &amp; Effects</h2>

      <!-- Border Radius -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Border Radius</h3>
        <div class="grid" data-columns="4" style="--gap: 1rem">
          <?php
          $radii = [
            ['--radius-xs', '8px'],
            ['--radius-sm', '12px'],
            ['--radius-md', '16px'],
            ['--radius-lg', '24px'],
            ['--radius-xl', '40px'],
          ];
          foreach ($radii as [$var, $val]): ?>
            <div style="padding: 1.5rem; background: var(--color-secondary); border-radius: var(<?php echo esc_attr($var); ?>); text-align: center">
              <code style="font-size: var(--size-sm); display: block"><?php echo esc_html($var); ?></code>
              <span style="font-size: var(--size-xs); opacity: 0.6"><?php echo esc_html($val); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Shadow -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Shadow</h3>
        <div class="grid" data-columns="2" style="--gap: 1rem">
          <div style="padding: 1.5rem; background: var(--color-white); border-radius: var(--radius-md); box-shadow: var(--shadow-base); text-align: center">
            <code style="font-size: var(--size-sm)">--shadow-base</code>
            <p style="font-size: var(--size-xs); opacity: 0.6; margin-top: 0.25rem">rgba(99,99,99,0.2) 0px 2px 8px 0px</p>
          </div>
        </div>
      </div>

      <!-- Borders -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Borders</h3>
        <div class="grid" data-columns="2" style="--gap: 1rem">
          <div style="padding: 1.5rem; border: var(--stroke-base); border-radius: var(--radius-md); text-align: center">
            <code style="font-size: var(--size-sm)">--stroke-base</code>
            <p style="font-size: var(--size-xs); opacity: 0.6; margin-top: 0.25rem">1px solid var(--color-black)</p>
          </div>
          <div style="padding: 1.5rem; border: var(--stroke-transparent); border-radius: var(--radius-md); text-align: center; outline: 1px dashed rgba(0,0,0,0.15)">
            <code style="font-size: var(--size-sm)">--stroke-transparent</code>
            <p style="font-size: var(--size-xs); opacity: 0.6; margin-top: 0.25rem">1px solid transparent</p>
          </div>
        </div>
      </div>

      <!-- Breakpoints -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Breakpoints</h3>
        <div class="box">
          <table style="width: 100%; border-collapse: collapse; font-size: var(--size-sm)">
            <thead>
              <tr style="border-bottom: var(--stroke-base)">
                <th style="text-align: left; padding: 0.5rem 0.75rem">Mixin</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem">Max-width</th>
                <th style="text-align: left; padding: 0.5rem 0.75rem">SCSS variable</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $bps = [
                ['@include sm', '390px',  '$breakpoint-sm'],
                ['@include md', '768px',  '$breakpoint-md'],
                ['@include lg', '991px',  '$breakpoint-lg'],
                ['@include xl', '1200px', '$breakpoint-xl'],
              ];
              foreach ($bps as [$mixin, $width, $var]): ?>
                <tr style="border-bottom: 1px solid rgba(0,0,0,0.07)">
                  <td style="padding: 0.5rem 0.75rem"><code><?php echo esc_html($mixin); ?></code></td>
                  <td style="padding: 0.5rem 0.75rem; opacity: 0.7"><?php echo esc_html($width); ?></td>
                  <td style="padding: 0.5rem 0.75rem; opacity: 0.7"><code><?php echo esc_html($var); ?></code></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Transition -->
      <div class="flow" style="--flow-space: 1rem">
        <h3>Transition</h3>
        <div class="box repel">
          <div>
            <code>--transition-base</code>
            <p style="font-size: var(--size-xs); opacity: 0.6; margin-top: 0.25rem">all 0.3s ease</p>
          </div>
          <a href="#effects" class="button">Hover me</a>
        </div>
      </div>

    </div>
  </section>

</main>

<?php get_footer(); ?>
