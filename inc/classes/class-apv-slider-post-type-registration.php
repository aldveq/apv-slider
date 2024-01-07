<?php

/**
 * @package APV_Slider
 */

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;

if (!class_exists('APV_Slider_Post_Type_Registration')) :
	class APV_Slider_Post_Type_Registration
	{
		use Singleton;

		protected function __construct()
		{
			add_action('init', array($this, 'slider_post_type_register'));
		}

		public function slider_post_type_register()
		{
			register_post_type(
				'apv-slider',
				array(
					'label' => 'Slider',
					'description' => 'Sliders',
					'labels' => array(
						'name' => 'Sliders',
						'singular_name' => 'Slider'
					),
					'public' => false,
					'supports' => array('title', 'editor', 'thumbnail'),
					'hierarchical' => false,
					'show_ui' => true,
					'show_in_menu' => true,
					'menu_position' => 5,
					'show_in_admin_bar' => true,
					'show_in_nav_menus' => true,
					'can_export' => true,
					'has_archive' => false,
					'exclude_from_search' => false,
					'publicly_queryable' => false,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-images-alt2',
				)
			);
		}
	}
endif;
