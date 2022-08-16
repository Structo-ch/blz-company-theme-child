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
