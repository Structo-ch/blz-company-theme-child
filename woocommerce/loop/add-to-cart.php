<?php

/**
 * Loop Add to Cart -- with quantity and AJAX
 * requires associated JavaScript file qty-add-to-cart.js
 *
 * @link http://snippets.webaware.com.au/snippets/woocommerce-add-to-cart-with-quantity-and-ajax/
 * @link https://gist.github.com/mikejolley/2793710/
 */

// add this file to folder "woocommerce/loop" inside theme

global $product;

if ($product->get_price() === '' && $product->product_type != 'external') return;
?>

<?php if (!$product->is_in_stock()) : ?>

    <a href="<?php echo get_permalink($product->id); ?>" class="button out_of_stock"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Out of stock', 'woocommerce')); ?></a>

<?php else : ?>

    <?php

    switch ($product->product_type) {
        case "variable":
            $link   = get_permalink($product->id);
            $label  = apply_filters('variable_add_to_cart_text', __('Select options', 'woocommerce'));
            break;
        case "grouped":
            $link   = get_permalink($product->id);
            $label  = apply_filters('grouped_add_to_cart_text', __('View options', 'woocommerce'));
            break;
        case "external":
            $link   = get_permalink($product->id);
            $label  = apply_filters('external_add_to_cart_text', __('Read More', 'woocommerce'));
            break;
        default:
            $link   = esc_url($product->add_to_cart_url());
            $label  = apply_filters('add_to_cart_text', __('Add to cart', 'woocommerce'));
            break;
    }

    //printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->id, $product->product_type, $label);

    if ($product->product_type == 'simple') {

    ?>
        <form action="<?php echo esc_url($product->add_to_cart_url()); ?>" class="cart cart-simple-product" method="post" enctype='multipart/form-data'>

            <?php woocommerce_quantity_input(); ?>

            <button type="submit" data-quantity="1" data-product_id="<?php echo $product->id; ?>" class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><i aria-hidden="true" class="fas fa-shopping-cart"></i></button>

        </form>
    <?php

    } elseif ($product->product_type == 'variable') {
        printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s"><div class=""><i aria-hidden="true" class="fas fa-shopping-cart"></i></div></a>', $link, $product->id, $product->product_type);
    } 
    else {

        printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->id, $product->product_type, $label);
    }

    ?>

<?php endif; ?>