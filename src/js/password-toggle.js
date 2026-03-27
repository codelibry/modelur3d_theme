function PasswordToggle() {
  jQuery(function ($) {
    let toggleIndex = 0;

    const ensureToggleId = ($input) => {
      if (!$input.attr('data-password-toggle-id')) {
        $input.attr('data-password-toggle-id', `pw-toggle-${++toggleIndex}`);
      }
      return $input.attr('data-password-toggle-id');
    };

    const findNearestInput = ($toggle) => {
      let $input = $toggle.prevAll('input[type="password"], input[type="text"]').first();
      if ($input.length) return $input;
      const $row = $toggle.closest('p, .form-row, .woocommerce-form-row, .password-input');
      $input = $row.find('input[type="password"], input[type="text"]').first();
      if ($input.length) return $input;
      return $toggle.closest('form').find('input[type="password"], input[type="text"]').first();
    };

    // Extracted so it can be called on any container, not just document
    const initToggles = (context) => {
      $(context).find('input[type="password"]').each(function () {
        const $input = $(this);

        // Already has a sibling toggle injected (by PHP or a previous JS run)
        if ($input.siblings('.show-password-input').length) {
          const $toggle = $input.siblings('.show-password-input').first();
          if (!$toggle.attr('data-target')) {
            $toggle.attr('data-target', ensureToggleId($input));
          }
          return;
        }

        // Inject toggle via JS as fallback
        const targetId = ensureToggleId($input);
        const $toggle = $(
          `<span class="show-password-input" data-target="${targetId}">
            <span class="show-password-input__icon show-password-input__icon--show"></span>
            <span class="show-password-input__icon show-password-input__icon--hide"></span>
          </span>`
        );
        $input.after($toggle);
      });
    };

    // Run on initial load
    initToggles(document.body);

    // Re-run whenever WooCommerce updates checkout/fragments
    $(document.body).on(
      'wc_fragments_loaded wc_fragments_refreshed updated_checkout',
      function () { initToggles(document.body); }
    );

    // Watch for any dynamically injected password fields (popups, page builders, etc.)
    const observer = new MutationObserver((mutations) => {
      for (const mutation of mutations) {
        for (const node of mutation.addedNodes) {
          if (node.nodeType !== 1) continue; // elements only
          // If the added node itself is or contains a password input
          if (
            $(node).is('input[type="password"]') ||
            $(node).find('input[type="password"]').length
          ) {
            initToggles(node);
          }
        }
      }
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Click handler stays delegated — works for all present and future toggles
    $(document.body).on('click', '.show-password-input', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      const $toggle = $(this);
      const targetId = $toggle.attr('data-target');
      let $input = targetId ? $(`[data-password-toggle-id="${targetId}"]`) : $();

      if (!$input.length) {
        $input = findNearestInput($toggle);
        if ($input.length) $toggle.attr('data-target', ensureToggleId($input));
      }

      if (!$input.length) return;

      const isPassword = $input.attr('type') === 'password';
      $input.attr('type', isPassword ? 'text' : 'password');
      $toggle.toggleClass('display-password', isPassword);
    });
  });
}

export default PasswordToggle;