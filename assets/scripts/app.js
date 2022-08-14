import Swiper from 'swiper';

console.log('Start Hello-Elementor');
//now let's see if we can call it
(function ($) {
  $(document).ready(() => {
    console.log('slider');
    const swiper = new Swiper(
      '#rn-tiny-slider .elementor-shortcode > .elementor',
      { wrapperClass:'elementor',loop: true }
    );
    console.log('Riko', swiper);
    
  });
})(jQuery);
