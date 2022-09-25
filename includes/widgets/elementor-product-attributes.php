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

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Justified', 'elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{SELECTOR}} .woocommerce-product-attributes.shop_attributes' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $product;
        if ($product->has_attributes()) {
            $settings = $this->get_settings_for_display();

            $style = "--justify-content: ".$settings['align'].";";
?>
            <div style="<?php echo $style;?>">
                <?php
                wc_display_product_attributes($product);
                ?>
            </div>
<?php
        }
    }
}
