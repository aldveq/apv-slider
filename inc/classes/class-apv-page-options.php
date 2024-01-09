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
				->set_page_file( 'apv-slider-settings' )
				->add_tab( __( 'General Settings', 'apv-slider' ), array(
					Field::make( 'html', 'apv_slider_general_settings_desc' )
    					->set_html( '<h2 style="margin: 0; padding: 0;"><strong>How does it work?</strong></h2><br><p style="margin: 0; padding: 0;">Use the shortcode <code>[apv_slider]</code> to display the slider in any page, post or widget.</p><br><p style="margin: 0; padding: 0;">Use the attribute <code>ids="1, 2, 3"</code> to display slides by slider post type id.</p><br><p style="margin: 0; padding: 0;">Use the attribute <code>orderby="rand"</code> to order the slides by an specific order (date order by default).</p>' ),
				) )
				->add_tab( __( 'Advanced Settings', 'apv-slider' ), array( 
					Field::make( 'html', 'apv_slider_advanced_settings_desc' )
    					->set_html( '<h2 style="margin: 0; padding: 0;"><strong>Other plugin settings</strong></h2>' ),
					Field::make( 'text', 'apv_slider_advanced_settings_title', __( 'Title', 'apv-slider' ) )
						->set_width( 50 ),
					Field::make( 'select', 'apv_slider_advanced_settings_style', __( 'Style', 'apv-slider' ) )
						->set_width( 50 )
						->set_options( array(
							'style-1' => __( 'Style One', 'apv-slider' ),
							'style-2' => __( 'Style Two', 'apv-slider' )
						) ),
					Field::make( 'checkbox', 'apv_slider_advanced_settings_disable_title', __( 'Disable title?', 'apv-slider' ) )
						->set_width( 50 ),
					Field::make( 'checkbox', 'apv_slider_advanced_settings_bullets', __( 'Disable bullets?', 'apv-slider' ) )
						->set_width( 50 ),
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
