<?php
/*
 * Plugin Name:       APV Slider
 * Plugin URI:        https://wordpress.org/plugins/avp-slider
 * Description:       Free WordPress Slider Plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aldo Paz Velasquez
 * Author URI:        https://apazvelasquez.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       apv-slider
 * Domain Path:       /languages
 */

/*
APV Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

APV Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with APV Slider. If not, see {URI to Plugin License}.
*/

if (!defined('ABSPATH')) :
	exit;
endif;

if (!class_exists('APV_Slider')) :
	class APV_Slider
	{
		public function __construct()
		{
			$this->define_constants();

			require_once(APV_SLIDER_PATH . 'inc/post-types/class-apv-cpt.php');
			$APV_Slider_Post_Type = new APV_Slider_Post_Type();
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

if (class_exists('APV_Slider')) :
	register_activation_hook(__FILE__, array('APV_Slider', 'activate'));
	register_deactivation_hook(__FILE__, array('APV_Slider', 'deactivate'));
	register_uninstall_hook(__FILE__, array('APV_Slider', 'uninstall'));

	$apv_slider = new APV_Slider();
endif;
