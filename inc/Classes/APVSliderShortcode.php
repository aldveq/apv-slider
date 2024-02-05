<?php

/**
 * APV Slider Shortcode Class
 *
 * This class loads the Carbon Fields Library.
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

if (! class_exists('APVSliderShortcode') ) {
    /**
     * APV Slider Shortcode class
     *
     * @category Plugins
     * @package  WordPress
     * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
     * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/plugins/plugin-basics/
     * @see      APVSliderSingleton
     */
    class APVSliderShortcode extends APVSliderSingleton
    {

        /**
         * APV Slider Shortcode Construct function
         */
        protected function __construct()
        {
            add_action('init', array( $this, 'apvSliderShortcodeSetup' ));
        }

        /**
         * APV Slider Shortcode Setup function
         *
         * @return void
         */
        public function apvSliderShortcodeSetup()
        {
            add_shortcode('apv_slider', array( $this, 'apvSliderShortcode' ));
        }

        /**
         * APV Slider Shortcode function
         *
         * @param array  $atts    Shortcode Attributes
         * @param string $content Content of the Shortcode
         * @param string $tag     Shortcode tag
         *
         * @return void
         */
        public function apvSliderShortcode( 
            $atts = array(), 
            $content = null, 
            $tag = '' 
        ) {
            // Making all attributes lower caase
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            // Extracting every single shortcode attribute to handle it by case
            extract(
                shortcode_atts(
                    array(
                    'ids'     => '',
                    'orderby' => 'date',
                    ),
                    $atts,
                    $tag
                )
            );

            // Making sure ids are positive integer values
            if (! empty($ids) ) :
                $ids = array_map('absint', explode(',', $ids));
            endif;

            ob_start();
            APVSliderViews::apvSliderShortcodeView($ids, $orderby, $content);
            wp_enqueue_script('apv-slider-flexslider-src-script');
            wp_enqueue_script('apv-slider-flexslider-script');
            wp_enqueue_style('apv-slider-flexslider-src-styles');
            wp_enqueue_style('apv-slider-flexslider-styles');
            return ob_get_clean();
        }
    }
}
