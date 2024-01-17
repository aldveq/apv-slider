<?php
/**
 * @package APV_Slider
 */

namespace APVSliderPlugin\Classes;

if (!class_exists('APVSliderInit')) :
	class APVSliderInit extends APVSliderSingleton
	{
		public function __construct()
		{
			$this->define_constants();
			add_action( 'wp_enqueue_scripts', array( $this, 'apv_slider_scripts' ) );

			// Other Classes Instances
			APVSliderCarbonFieldsSetup::get_instance();
			APVSliderPageOptions::get_instance();
			APVSliderPostTypeRegistration::get_instance();
			APVSliderShortcode::get_instance();
		}

		public function define_constants()
		{
			define('APV_SLIDER_URL', plugins_url() . '/apv-slider/');
			define('APV_SLIDER_VERSION', '1.0.0');
		}

		public function apv_slider_scripts() {
			wp_register_script( 
				'apv-slider-flexslider-src-script', 
				APV_SLIDER_URL . 'assets/vendors/flexslider/jquery.flexslider-min.js', 
				array( 'jquery' ), 
				APV_SLIDER_VERSION,
				true
			);

			wp_register_script( 
				'apv-slider-flexslider-script', 
				APV_SLIDER_URL . 'assets/vendors/flexslider/flexslider.js', 
				array( 'jquery' ), 
				APV_SLIDER_VERSION,
				true
			);

			wp_register_style( 
				'apv-slider-flexslider-src-styles',
				APV_SLIDER_URL . 'assets/vendors/flexslider/flexslider.css', 
				array(), 
				APV_SLIDER_VERSION, 
				'all' 
			);

			wp_register_style( 
				'apv-slider-flexslider-styles',
				APV_SLIDER_URL . 'assets/css/apv-slider-styles.css', 
				array(), 
				APV_SLIDER_VERSION, 
				'all' 
			);

			wp_localize_script(
				'apv-slider-flexslider-script',
				'SLIDER_OPTIONS',
				array(
					'isSliderBulletsDisabled' => carbon_get_theme_option( 'apv_slider_advanced_settings_bullets' ),
				)
			);
		}

		public static function activate()
		{
			update_option('rewrite_rules', '');
		}

		public static function deactivate()
		{
			flush_rewrite_rules();
			unregister_post_type('apv-slider');
		}

		public static function uninstall()
		{
			delete_option( 'apv_slider_advanced_settings_disable_title' );
			delete_option( 'apv_slider_advanced_settings_title' );
			delete_option( 'apv_slider_advanced_settings_bullets' );
			delete_option( 'apv_slider_advanced_settings_style' );

			$apv_slider_posts = get_posts( array(
				'post_type' => 'apv-slider',
				'number_posts' => -1,
				'post_status' => 'any'
			) );

			foreach ($apv_slider_posts as $apv_post):
				wp_delete_post( $apv_post->ID, true );
			endforeach;
		}
	}
endif;
