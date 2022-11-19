<?php

add_action('elementor/theme/register_conditions', function ($conditions_manager) {

	class Subcategory_Archive extends ElementorPro\Modules\ThemeBuilder\Conditions\Taxonomy
	{
		private $taxonomy;

		public function get_name()
		{
			return 'child_of_' . $this->taxonomy->name;
		}

		public function get_label()
		{
			return sprintf(__('Direct Child %s Of', 'elementor-pro'), $this->taxonomy->labels->singular_name);
		}

		public function __construct($data)
		{
			parent::__construct($data);

			$this->taxonomy = $data['object'];
		}

		public function is_term()
		{
			$taxonomy = $this->taxonomy->name;
			$current = get_queried_object();
			return ($current && isset($current->taxonomy) && $taxonomy === $current->taxonomy);
		}

		public function check($args)
		{
			$id = (int) $args['id'];
			/**
			 * @var \WP_Term $current
			 */
			$current = get_queried_object();
			if (!$this->is_term() || 0 === $current->parent) {
				return false;
			}

			while ($current->parent > 0) {
				if ($id === $current->parent) {
					return true;
				}
				$current = get_term_by('id', $current->parent, $current->taxonomy);
			}

			return $id === $current->parent;
		}
	}
	$taxonomy = get_taxonomy('product_cat');
	$conditions_manager->get_condition('product_archive')->register_sub_condition(
		new Subcategory_Archive(['object' => $taxonomy])
	);
}, 100);
