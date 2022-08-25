import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

const swiperHeaderHome = {
  swiperContainer: '.mySwiper .elementor-shortcode',
  settings: {
    wrapperClass: 'elementor-260',
  }
};
const swiperProductHome = {
  swiperContainer: '.disable-elementor-grid .woocommerce',
  settings: {
    slidesPerView: 3,
    wrapperClass: 'products',
  }
};

document.querySelectorAll('.disable-elementor-grid .woocommerce li.product').forEach(
  product => {
    product.classList.add('swiper-slide')
  }
)



const swipers = [swiperProductHome, swiperHeaderHome];

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
      loop: true,
      speed: 300,
      slidesPerView: 1,
      centeredSlides: true,
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
    }
    
    new Swiper(swiperContainer, {...defaultSettings, ...swiper.settings } );
  }
});
