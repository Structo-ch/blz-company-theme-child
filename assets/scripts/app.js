import Swiper from 'swiper/bundle';
import '../scss/app.scss';
import 'swiper/css/bundle';

console.log('Start Hello-Elementor');

const swiperContainer = '.mySwiper .elementor-shortcode';

const NodeSwiperContainer = document.querySelectorAll(swiperContainer);
if (NodeSwiperContainer.length > 0) {
  const buttonsClass = {
    swiperNext: 'swiper-button-next',
    swiperPrev: 'swiper-button-prev',
    swiperPagination: 'swiper-pagination',
  };

  Object.values(buttonsClass).forEach((buttonClass) => {
    const nodeButton = document.createElement('div');
    nodeButton.classList.add(buttonClass);
    NodeSwiperContainer[0].appendChild(nodeButton);
  });

  new Swiper(swiperContainer, {
    loop: true,
    speed: 300,
    slide: 1,
    slidesPerView: 1,
    centeredSlides: true,
    wrapperClass: 'elementor-260',
    grabCursor: true,

    pagination: {
      el: `.${buttonsClass.swiperPagination}`,
      clickable: true,
    },

    navigation: {
      nextEl: `.${buttonsClass.swiperNext}`,
      prevEl: `.${buttonsClass.swiperPrev}`,
    },

    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
  });
}

const funcQuerySelectorQuantity = (selector) => (isSubmittable) => {
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
    .forEach((selector) => funcQuerySelectorQuantity(selector)(false));
};
document
  .querySelectorAll('form.cart')
  .forEach((form) => funcQuerySelectorQuantity(form)(true));

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
}
updateFragments()
elementorFrontend.elements.$body.on('wc_fragments_refreshed', () =>
  updateFragments()
);
