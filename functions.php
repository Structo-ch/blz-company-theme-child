<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

require_once(dirname(__FILE__) ."/includes/scripts-js-css.php");
require_once(dirname(__FILE__) ."/includes/elementor-query.php");
require_once(dirname(__FILE__) ."/includes/categories.php");
require_once(dirname(__FILE__) ."/includes/single-product.php");


function filter_woocommerce_post_class($classes, $product)
{
    // is_product() - Returns true on a single product page
    // NOT single product page, so return
    if (!is_product()) return $classes;

    // Add new class
    $classes[] = 'swiper-slide';

    return $classes;
}
add_filter('woocommerce_post_class', 'filter_woocommerce_post_class', 10, 2);