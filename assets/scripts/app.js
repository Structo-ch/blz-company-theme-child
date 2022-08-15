import Swiper from 'swiper';
import '../scss/app.scss';
import 'swiper/core';

console.log('Start Hello-Elementor');

const swiper = new Swiper('.mySwiper .elementor-shortcode', {
  loop: true,
  speed: 300,
  slide: 1,
  slidesPerView: 1,
  centeredSlides:true,
  wrapperClass: 'elementor-260',
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});