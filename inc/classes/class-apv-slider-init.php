<?php

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;

if (!class_exists('APV_Slider_Init')) :
	class APV_Slider_Init
	{
		use Singleton;

		protected function __construct()
		{
			$this->define_constants();
			register_activation_hook(APV_SLIDER_URL . '/apv-slider.php', array($this, 'activate'));
			register_deactivation_hook(APV_SLIDER_URL . '/apv-slider.php', array($this, 'deactivate'));
			register_uninstall_hook(APV_SLIDER_URL . '/apv-slider.php', array($this, 'uninstall'));

			// Other Classes Instances
			APV_Slider_Post_Type::get_instance();
		}

		public function define_constants()
		{
			define('APV_SLIDER_PATH', plugin_dir_path(__FILE__));
			define('APV_SLIDER_URL', plugin_dir_url(__FILE__));
			define('APV_SLIDER_VERSION', '1.0.0');
		}

		public function activate()
		{
			update_option('rewrite_rules', '');
		}

		public function deactivate()
		{
			flush_rewrite_rules();
			unregister_post_type('apv-slider');
		}

		public function uninstall()
		{
		}
	}
endif;
