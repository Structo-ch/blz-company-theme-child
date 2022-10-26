<?php
// Custom conditional function that checks also for parent product categories
function has_product_category($product_id, $category_ids)
{
    $term_ids = array(); // Initializing

    // Loop through the current product category terms to get only parent main category term
    foreach (get_the_terms($product_id, 'product_cat') as $term) {
        if ($term->parent > 0) {
            $term_ids[] = $term->parent; // Set the parent product category
            $term_ids[] = $term->term_id;
        } else {
            $term_ids[] = $term->term_id;
        }
    }
    return array_intersect($category_ids, array_unique($term_ids));
}


remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_subtitle', 15);
function woocommerce_template_loop_product_subtitle()
{
    $subtitle = get_field('sous-titre');
    echo '<div class="subtitle">' . $subtitle . '</div>';
}


add_action('woocommerce_check_cart_items', 'woocommerce_check_cart_quantities');
function woocommerce_check_cart_quantities()
{
    $multiples = 12;
    $total_products = 0;
    $category_ids = array(17, 22);
    $found = false;

    foreach (WC()->cart->get_cart() as $cart_item) {
        if (has_product_category($cart_item['product_id'], $category_ids)) {
            $total_products += $cart_item['quantity'];
            $found = true;
        }
    }
    if (($total_products % $multiples) > 0 && $found) {
        $missing_product = $multiples - ($total_products % $multiples);
        $message = '';
        while ($missing_product-- > 0) {
            $message .= '<i aria-hidden="true" class="fas fa-wine-bottle"></i>';
        }
        wc_add_notice(sprintf(__('<strong>Attention</strong> : Il manque %s pour remplir ta caisse !'), $message), 'error');
        remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
    }
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
