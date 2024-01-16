<?php

/**
 * @package APV_Slider
 */

namespace APVSliderPlugin\Classes;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

if (!class_exists('APVSliderPostTypeRegistration')) :
	class APVSliderPostTypeRegistration extends APVSliderSingleton
	{
		protected function __construct()
		{
			add_action('init', array($this, 'slider_post_type_register'));
			add_action( 'carbon_fields_register_fields', array( $this, 'slider_post_type_fields' ) );
		}

		public function slider_post_type_register()
		{
			register_post_type(
				'apv-slider',
				array(
					'label' => esc_html__( 'Slider', 'apv-slider' ),
					'description' => esc_html__( 'Sliders', 'apv-slider' ),
					'labels' => array(
						'name' => esc_html__( 'Sliders', 'apv-slider' ),
						'singular_name' => esc_html__( 'Slider', 'apv-slider' )
					),
					'public' => false,
					'supports' => array('title', 'editor', 'thumbnail'),
					'hierarchical' => false,
					'show_ui' => true,
					'show_in_menu' => false,
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

		public function slider_post_type_fields() {
			Container::make( 'post_meta', esc_html__( 'Link Options', 'apv-slider' ) )
				->where( 'post_type', '=', 'apv-slider' )
				->add_fields(
					array(
						Field::make( 'text', 'slider_link_text', esc_html__( 'Text', 'apv-slider' ) )
							->set_width( 33 ),
						Field::make( 'text', 'slider_link_url', esc_html__( 'URL', 'apv-slider' ) )
							->set_width( 33 ),
						Field::make( 'checkbox', 'slider_link_target', esc_html__( 'Open in new tab?', 'apv-slider' ) )
							->set_width( 33 ),
					)
				);
		}
	}
endif;
