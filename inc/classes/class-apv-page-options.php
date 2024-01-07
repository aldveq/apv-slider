<?php
/**
 * @package APV_Slider
 */

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

if (!class_exists('APV_Page_Options')) :
	class APV_Page_Options
	{
		use Singleton;

		protected function __construct()
		{
			add_action( 'carbon_fields_register_fields', array( $this, 'apv_slider_plugin_options' ) );
			add_action( 'admin_menu', array( $this, 'apv_slider_plugin_submenu_options' ) );
		}

		public function apv_slider_plugin_options() {
			$apv_slider_options_parent_item = Container::make( 'theme_options', __('APV Slider', 'apv-slider') )
				->set_page_file( 'apv-slider-options' )
				->set_icon( 'dashicons-images-alt2' );

			Container::make( 'theme_options', __('Settings', 'apv-slider') )
				->set_page_parent( $apv_slider_options_parent_item )
				->add_fields( array( 
					Field::make( 'text', 'apv_slider_options_text', __( 'Text', 'apv-slider' ) )
				 ) );
		}

		public function apv_slider_plugin_submenu_options() {
			add_submenu_page(
				'apv-slider-options',
				'Manage Slides',
				'Manage Slides',
				'manage_options',
				'edit.php?post_type=apv-slider',
				null,
				null
			);

			add_submenu_page(
				'apv-slider-options',
				'Add New Slide',
				'Add New Slide',
				'manage_options',
				'post-new.php?post_type=apv-slider',
				null,
				null
			);
		}
	}
endif;
