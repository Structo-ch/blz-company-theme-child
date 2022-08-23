console.log('Start cartMinusPlus');

const funcQuerySelectorQuantity = (selector) => {
  const input = selector.querySelector('input.qty');

  const changeValue = (value) => {
    input.value = parseInt(input.value) + value;
  };

  const dispatchChangeEvent = () => {
    input.dispatchEvent(new Event('change'));
    document
      .querySelectorAll('button[name="update_cart"]')
      .forEach((button) => {
        button.dispatchEvent(new Event('change'));
      });
  };

  const verifyValue = (input) => {
    if (parseInt(input.value) < parseInt(input.attributes.min.value)) {
      input.value = input.attributes.min.value;
    }
    if (parseInt(input.value) > parseInt(input.attributes.max.value)) {
      input.value = input.attributes.max.value;
    }
  };

  const changeValueSubmit = () => {
    selector.querySelectorAll('button[type="submit"]').forEach((submit) => {
      submit.dataset.quantity = input.value;
    });
  };

  const addEventListenerQuantity = (element) => (value) => {
    element.addEventListener('click', () => {
      changeValue(value);
      dispatchChangeEvent();
    });
  };

  selector
    .querySelectorAll('.quantity-up')
    .forEach((element) => addEventListenerQuantity(element)(1));
  selector
    .querySelectorAll('.quantity-down')
    .forEach((element) => addEventListenerQuantity(element)(-1));

  input.addEventListener('change', () => {
    verifyValue(input);
    changeValueSubmit();
  });
};

const formCartItemAction = () => {
  document
    .querySelectorAll('.woocommerce-cart-form__cart-item')
    .forEach((selector) => funcQuerySelectorQuantity(selector));
};
document
  .querySelectorAll('form.cart')
  .forEach((form) => funcQuerySelectorQuantity(form));

const updateCartAddEventListener = () => {
  document.querySelectorAll('button[name="update_cart"]').forEach((button) => {
    const activeButtonUpdateCart = () => {
      button.disabled = false;
      button.attributes['aria-disabled'].value = false;
    };
    button.addEventListener('change', activeButtonUpdateCart);
  });
};

const updateFragments = () => {
  formCartItemAction();
  updateCartAddEventListener();
};
updateFragments();
elementorFrontend.elements.$body.on('wc_fragments_refreshed', () =>
  updateFragments()
);
