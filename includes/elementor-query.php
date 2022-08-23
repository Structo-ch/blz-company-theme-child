<?php

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
