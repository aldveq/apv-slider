<?php
/**
 * @package APV_Slider
 */

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;

if (!class_exists('APV_Slider_Init')) :
	class APV_Slider_Init
	{
		use Singleton;

		protected function __construct()
		{
			$this->define_constants();

			// Other Classes Instances
			APV_Carbon_Fields_Setup::get_instance();
			APV_Page_Options::get_instance();
			APV_Slider_Post_Type_Registration::get_instance();
			APV_Slider_Shortcode::get_instance();
		}

		public function define_constants()
		{
			define('APV_SLIDER_PATH', plugin_dir_path(__FILE__));
			define('APV_SLIDER_URL', plugin_dir_url(__FILE__));
			define('APV_SLIDER_VERSION', '1.0.0');
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
		}
	}
endif;
