<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts()
{
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/dist/app.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);

	wp_enqueue_script('my-app', get_stylesheet_directory_uri() . '/dist/app.js', array('jquery', 'elementor-frontend'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

add_action('elementor/query/request_category_spiritueux', function ($query) {
	$query = new WP_Query(array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'spiritueux',
				'include_children' => true,
			),
		),
	));
	var_dump($query);
});

add_action('elementor/query/request_category_bieres', function ($query) {
	$query = new WP_Query(array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'bieres',
				'include_children' => true,
			),
		),
	));
	var_dump($query);
});

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
