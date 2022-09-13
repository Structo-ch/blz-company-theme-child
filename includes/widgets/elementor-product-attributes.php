<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Button fixed
 *
 * Elementor widget for fixed button.
 *
 * @since 1.0.0
 */
class RN_elementor_product_attributes extends \Elementor\Widget_Base
{
    public function get_categories()
    {
        return ['Radon-elements'];
    }

    /**
     * Retrieve button widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'RN_elementor_product_attributes';
    }

    /**
     * Retrieve button widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Product attributes', 'elementor-radon');
    }

    /**
     * Retrieve button widget icon.
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    protected function render()
    {
        global $product;
        if ($product->has_attributes()) {
            wc_display_product_attributes($product);
        }
    }
}
