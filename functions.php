<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

require_once(dirname(__FILE__) . "/includes/scripts-js-css.php");
require_once(dirname(__FILE__) . "/includes/elementor-query.php");
require_once(dirname(__FILE__) . "/includes/categories.php");
require_once(dirname(__FILE__) . "/includes/single-product.php");
require_once(dirname(__FILE__) . "/includes/subcategory_archive.php");
require_once(dirname(__FILE__) . "/includes/google-analytics.php");

function register_list_widget($widgets_manager)
{

    require_once(__DIR__ . '/includes/widgets/elementor-product-attributes.php');
    require_once(__DIR__ . '/includes/widgets/customAddToCart.php');
    require_once(__DIR__ . '/includes/widgets/elementor-product-playlist.php');

    $widgets_manager->register(new \RN_elementor_product_attributes());
    $widgets_manager->register(new \RN_elementor_custom_add_to_cart());
    $widgets_manager->register(new \RN_elementor_product_playlist());
}
add_action('elementor/widgets/register', 'register_list_widget');


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
