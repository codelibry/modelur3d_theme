/*
 * Popup
 */
function InitPopups() {

  class Popup {
    constructor(el){
      this.query(el);
      this.events();
    }

    query(el) {
      this.popup = el;
      this.closeButton = el.querySelector('.popup__close');
      this.cancelButton = el.querySelector('.popup__cancel');
      this.buttons = [...document.querySelectorAll(`a[href="#${el.id}"]`)];
    }

    events() {
      window.addEventListener('load', this.windowLoadHandler.bind(this));
      
      if (this.popup.id !== 'checkout-popup') {
        this.buttons.forEach(button =>
          button.addEventListener('click', this.buttonClickHandler.bind(this))
        );
      }

      this.popup.addEventListener('click', this.popupClickHandler.bind(this));
      this.closeButton.addEventListener('click', () => this.handleClose());

      if (this.cancelButton) {
        this.cancelButton.addEventListener('click', () => this.handleClose());
      }

      this.popup.addEventListener('close', () => {
        if (this.popup.id === 'checkout-popup') {
          this.clearTopUpCart();
        }
        // Also clear inputs on native dialog close events (like pressing Esc)
        this.clearFormInputs(); 
      });
    }

    buttonClickHandler(e) {
      document.querySelectorAll('dialog').forEach((el) => {
        el.close();
      });

      this.popup.showModal();
    }

    removeHash() {
      if (window.location.hash === `#${this.popup.id}`) {
        history.replaceState(
          null,
          document.title,
          window.location.pathname + window.location.search
        );
      }
    }

    handleClose() {
      this.popup.close();
      this.cleanPopupMessages();
      this.clearFormInputs();

      // Clean reset-error query param and error message when reset popup closes
      if (this.popup.id === 'popup-reset-form') {
        const params = new URLSearchParams(window.location.search);
        if (params.has('reset-error')) {
          params.delete('reset-error');
          const clean = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
          history.replaceState(null, document.title, clean);
        }
        this.popup.querySelectorAll('.auth-error').forEach(el => el.remove());
        return;
      }

      const hasErrors = this.popup.querySelector('.woocommerce-error');
      if (!hasErrors) {
        this.removeHash();
      }
    }

    // NEW METHOD: Clears all inputs, textareas, and selects
    clearFormInputs() {
      const inputs = this.popup.querySelectorAll('input, textarea, select');
      inputs.forEach(input => {
        if (input.type === 'checkbox' || input.type === 'radio') {
          input.checked = false;
        } else {
          input.value = '';
        }
      });
    }

    cleanPopupMessages() {
      document.querySelectorAll('dialog').forEach((dialog) => {
        dialog.querySelectorAll('.woocommerce-notices-wrapper').forEach(wrapper => wrapper.remove());
      });
    }

    popupClickHandler(e) {
      const rect = this.popup.getBoundingClientRect();

      const clickedOutside =
        e.clientX < rect.left ||
        e.clientX > rect.right ||
        e.clientY < rect.top ||
        e.clientY > rect.bottom;

      if (clickedOutside) {
        this.handleClose();
      }
    }

    windowLoadHandler() {
      const hash = window.location.hash;
      if (!hash) return;
      const id = hash.substring(1);

      if(id === this.popup.id) {
        this.popup.showModal();
      }
    }

    async clearTopUpCart() {
      if (typeof rmTopUp === 'undefined') return;

      try {
        await fetch(rmTopUp.ajax_url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            action: 'rm_clear_top_up_cart',
            nonce: rmTopUp.nonce
          })
        });
      } catch (error) {
        console.error('Error clearing cart:', error);
      }
    }
  }

  window.popups = [];

  document.querySelectorAll('dialog').forEach((el) => {
    window.popups.push(new Popup(el));
  });

  if (
    document.body.classList.contains('woocommerce-account') &&
    window.location.hash
  ) {
    history.replaceState(
      null,
      document.title,
      window.location.pathname + window.location.search
    );
  }
}

export default InitPopups;