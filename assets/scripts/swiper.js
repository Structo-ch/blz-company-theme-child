import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

const swiperHeaderHome = {
  swiperContainer: '.mySwiper .elementor-shortcode',
  settings: {
    wrapperClass: 'elementor-260',
  },
};
const swiperProductSettings = {
  settings: {
    slidesPerView: 5,
    spaceBetween: 100,
    wrapperClass: 'products',
    breakpoints: {
      '@0.00': {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 30,
      },
      '@0.75': {
        slidesPerView: 2,
        slidesPerGroup: 2,
        spaceBetween: 50,
      },
      '@1.00': {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 50,
      },
      '@1.50': {
        slidesPerView: 5,
        slidesPerGroup: 5,
        spaceBetween: 50,
      },
    },
  },
};
const swiperProductHome = {
  swiperContainer: '.disable-elementor-grid.nos-bieres .woocommerce',
  ...swiperProductSettings,
};
const swiperSpiritueuxHome = {
  swiperContainer: '.disable-elementor-grid.nos-spiritueux .woocommerce',
  ...swiperProductSettings,
};

document
  .querySelectorAll('.disable-elementor-grid .woocommerce li.product')
  .forEach((product) => {
    product.classList.add('swiper-slide');
  });

const swipers = [swiperHeaderHome, swiperProductHome, swiperSpiritueuxHome];

swipers.forEach((swiper) => {
  const swiperContainer = swiper.swiperContainer;

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

    const defaultSettings = {
      speed: 600,
      slidesPerView: 1,
      centerInsufficientSlides: true,
      grabCursor: true,
      autoHeight: true,

      pagination: {
        el: `.${buttonsClass.swiperPagination}`,
        clickable: true,
      },

      navigation: {
        nextEl: `.${buttonsClass.swiperNext}`,
        prevEl: `.${buttonsClass.swiperPrev}`,
      },

      // autoplay: {
      //   delay: 5000,
      //   disableOnInteraction: false,
      //   pauseOnMouseEnter: true,
      // },
    };

    new Swiper(swiperContainer, { ...defaultSettings, ...swiper.settings });
  }
});
