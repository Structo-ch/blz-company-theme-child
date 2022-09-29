<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Button fixed
 *
 * Elementor widget for fixed button.
 *
 * @since 1.0.0
 */
class RN_elementor_product_playlist extends \Elementor\Widget_Base
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
        return 'RN_elementor_product_playlist';
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
        return __('Product playlist', 'elementor-radon');
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
            $settings = $this->get_settings_for_display();

            $style = "--justify-content: " . $settings['align'] . ";";
?>
            <div style="<?php echo $style; ?>">
                <?php
                wc_display_product_attributes($product);
                ?>
            </div>
<?php
        }
    }
}
