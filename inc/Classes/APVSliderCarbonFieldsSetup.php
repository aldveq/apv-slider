<?php
/**
 * APV Slider Carbon Fields Setup Class
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

if (!class_exists('APVSliderCarbonFieldsSetup')) {
    /**
     * APV Slider Carbon Fields Setup class
     *
     * @category Plugins
     * @package  WordPress
     * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
     * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/plugins/plugin-basics/
     * @see      APVSliderSingleton
     */
    class APVSliderCarbonFieldsSetup extends APVSliderSingleton
    {
        /**
         * APV Slider Carbon Fields Setup Construct function
         */
        protected function __construct()
        {
            add_action('plugins_loaded', array($this, 'loadCarbonFieldsLibrary'));
        }

        /**
         * Load Carbon Fields Library function
         *
         * @return void
         */
        public function loadCarbonFieldsLibrary()
        {
            \Carbon_Fields\Carbon_Fields::boot();
        }
    }
}//end if
