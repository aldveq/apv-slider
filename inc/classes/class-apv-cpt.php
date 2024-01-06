<?php

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;

if (!class_exists('APV_Slider_Post_Type')) :
	class APV_Slider_Post_Type
	{
		use Singleton;

		protected function __construct()
		{
			add_action('init', array($this, 'apv_slider_post_type_register'));
		}

		public function apv_slider_post_type_register()
		{
			echo '<pre>';
			var_dump('From CPT Class');
			echo '</pre>';

			register_post_type(
				'apv-slider',
				array(
					'label' => 'Slider',
					'description' => 'Sliders',
					'labels' => array(
						'name' => 'Sliders',
						'singular_name' => 'Slider'
					),
					'public' => true,
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
					'publicly_queryable' => true,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-images-alt2',
				)
			);
		}
	}
endif;
