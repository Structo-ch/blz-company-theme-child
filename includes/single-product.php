<?php
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_subtitle', 15);
function woocommerce_template_loop_product_subtitle()
{
    $subtitle = get_field('sous-titre');
    if ($subtitle) {
        echo '<div class="subtitle">' . $subtitle . '</div>';
    }
}


add_action('woocommerce_check_cart_items', 'woocommerce_check_cart_quantities');
function woocommerce_check_cart_quantities()
{
    $multiples = 6;
    $total_products = 0;
    $category_ids = array(17, 22);
    $found = false;

    foreach (WC()->cart->get_cart() as $cart_item) {
        if (has_product_category($cart_item['product_id'], $category_ids)) {
            $total_products += $cart_item['quantity'];
            $found = true;
        }
    }
    if (($total_products % $multiples) > 0 && $found)
        wc_add_notice(sprintf(__('You need to buy in quantities of %s products', 'woocommerce'), $multiples), 'error');
}

add_action('woocommerce_before_quantity_input_field', 'woocommerce_before_quantity_input_field_action');

/**
 * Function for `woocommerce_before_quantity_input_field` action-hook.
 * 
 * @return void
 */
function woocommerce_before_quantity_input_field_action()
{ ?>
    <div class="quantity-button quantity-down">-</div>
    <div class="quantity-button quantity-up">+</div>
<?php
}
