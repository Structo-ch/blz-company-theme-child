<?php
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
add_action('woocommerce_before_subcategory', function ($category) {
    echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '" style="background-color:' . get_field('couleur', $category)  . ';">';
}, 20);

remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action('woocommerce_before_subcategory', function ($category) {
?>
    <h2 class="woocommerce-loop-category__title" style="color:<?php echo get_field('text-color', $category); ?>;">
        <?php
        echo esc_html($category->name);
        ?>
    </h2>
<?php
}, 20);
