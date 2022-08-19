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

//fonction pour afficher le titre d'un custom post
