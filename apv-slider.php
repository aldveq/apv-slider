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

use APVSliderPlugin\Classes\APVSliderInit;

require_once dirname(__FILE__) . '/vendor/autoload.php';

APVSliderInit::get_instance();

if (class_exists('APVSliderInit')) :
	register_activation_hook(__FILE__, array('APVSliderInit', 'activate'));
	register_deactivation_hook(__FILE__, array('APVSliderInit', 'deactivate'));
	register_uninstall_hook(__FILE__, array('APVSliderInit', 'uninstall'));
endif;
