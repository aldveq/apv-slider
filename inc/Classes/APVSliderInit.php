<?php

/**
 * APV Slider Init Class
 *
 * This class is the entry point of the APV Slider Plugin
 *
 * PHP version 8
 *
 * @category Plugins
 * @package  WordPress
 * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
 * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/plugins/plugin-basics/
 */

namespace APVSliderPlugin\Classes;

if (! class_exists('APVSliderInit') ) {
    /**
     * APV Slider Init class
     *
     * @category Plugins
     * @package  WordPress
     * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
     * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/plugins/plugin-basics/
     * @see      APVSliderSingleton
     */
    class APVSliderInit extends APVSliderSingleton
    {

        /**
         * APV Slider Init Construct function
         */
        public function __construct()
        {
            $this->defineConstants();
            add_action(
                'after_setup_theme', 
                array( $this, 'apvSliderLoadTextdomain' )
            );
            add_action('wp_enqueue_scripts', array( $this, 'apvSliderScripts' ));

            // Other Classes Instances
            APVSliderCarbonFieldsSetup::getInstance();
            APVSliderPageOptions::getInstance();
            APVSliderPostTypeRegistration::getInstance();
            APVSliderShortcode::getInstance();
        }

        /**
         * Define Constants function
         *
         * @return void
         */
        public function defineConstants()
        {
            define('APV_SLIDER_URL', plugins_url() . '/apv-slider/');
            define('APV_SLIDER_VERSION', '1.0.0');
        }

        /**
         * APV Slider Load Textdomain function
         *
         * @return void
         */
        public function apvSliderLoadTextdomain()
        {
            load_plugin_textdomain('apv-slider', false, 'apv-slider/languages');
        }

        /**
         * APV Slider Scripts function
         *
         * This functions registers the necessary scripts for APV Slider Plugin
         *
         * @return void
         */
        public function apvSliderScripts()
        {
            wp_register_script(
                'apv-slider-flexslider-src-script',
                APV_SLIDER_URL . 'assets/jquery.flexslider-min.js',
                array( 'jquery' ),
                APV_SLIDER_VERSION,
                true
            );

            wp_register_script(
                'apv-slider-flexslider-script',
                APV_SLIDER_URL . 'build/index.js',
                array( 'jquery' ),
                APV_SLIDER_VERSION,
                true
            );

            wp_register_style(
                'apv-slider-flexslider-styles',
                APV_SLIDER_URL . 'build/index.css',
                array(),
                APV_SLIDER_VERSION,
                'all'
            );

            wp_localize_script(
                'apv-slider-flexslider-script',
                'SLIDER_OPTIONS',
                array(
                'isSliderBulletsDisabled'   => carbon_get_theme_option('apv_slider_advanced_settings_bullets'), // phpcs:ignore
                'isSliderNavArrowsDisabled' => carbon_get_theme_option('apv_slider_advanced_settings_nav_arrows'), // phpcs:ignore
                )
            );
        }

        /**
         * Active function
         *
         * @return void
         */
        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        /**
         * Deactivate function
         *
         * @return void
         */
        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type('apv-slider');
        }
    }
}
