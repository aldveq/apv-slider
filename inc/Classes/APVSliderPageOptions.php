<?php

/**
 * APV Slider Page Options Class
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

use Carbon_Fields\Container;
use Carbon_Fields\Field;

if (! class_exists('APVSliderPageOptions') ) {
    /**
     * APV Slider Page Options class
     *
     * @category Plugins
     * @package  WordPress
     * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
     * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/plugins/plugin-basics/
     * @see      APVSliderSingleton
     */
    class APVSliderPageOptions extends APVSliderSingleton
    {

        /**
         * APV Slider Page Options Construct function
         */
        protected function __construct()
        {
            add_action(
                'carbon_fields_register_fields', 
                array( $this, 'apvSliderPluginOptions' )
            );
            add_action(
                'admin_menu', 
                array( $this, 'apvSliderPluginSubmenuOptions' )
            );
        }

        /**
         * APV Slider Plugin Options function
         *
         * @return void
         */
        public function apvSliderPluginOptions()
        {
            $apv_slider_options_parent_item = Container::make('theme_options', esc_html__('APV Slider', 'apv-slider')) // phpcs:ignore
                ->set_page_file('apv-slider-options')
                ->set_icon('dashicons-images-alt2');

            Container::make('theme_options', esc_html__('Settings', 'apv-slider'))
                ->set_page_parent($apv_slider_options_parent_item)
                ->set_page_file('apv-slider-settings')
                ->add_tab(
                    esc_html__('General Settings', 'apv-slider'),
                    array(
                    Field::make('html', 'apv_slider_general_settings_desc')
            ->set_html('<h2 style="margin: 0; padding: 0;"><strong>' . esc_html__('How does it work?', 'apv-slider') . '</strong></h2><br><p style="margin: 0; padding: 0;">' . wp_kses(__('Use the shortcode <code>[apv_slider]</code> to display the slider in any page, post or widget.', 'apv-slider'), array('code' => array())) . '</p><br><p style="margin: 0; padding: 0;">' . wp_kses(__('Use the attribute <code>ids="1, 2, 3"</code> to display slides by slider post type id.', 'apv-slider'), array('code' => array())) . '</p><br><p style="margin: 0; padding: 0;">' . wp_kses(__('Use the attribute <code>orderby="rand"</code> to order the slides by an specific order (date order by default).', 'apv-slider'), array('code' => array())) . '</p>'), // phpcs:ignore
                    )
                )
                ->add_tab(
                    esc_html__('Advanced Settings', 'apv-slider'),
                    array(
                    Field::make('html', 'apv_slider_advanced_settings_desc')
            			->set_html('<h2 style="margin: 0; padding: 0;"><strong>' . esc_html__('Other plugin settings', 'apv-slider') . '</strong></h2>'), // phpcs:ignore
					Field::make('checkbox', 'apv_slider_advanced_settings_disable_title', esc_html__('Disable title?', 'apv-slider')) // phpcs:ignore
                    ->set_width(33),
					Field::make('checkbox', 'apv_slider_advanced_settings_bullets', esc_html__('Disable bullets?', 'apv-slider')) // phpcs:ignore
                    ->set_width(33),
					Field::make('checkbox', 'apv_slider_advanced_settings_nav_arrows', esc_html__('Disable nav arrows?', 'apv-slider')) // phpcs:ignore
                        ->set_width(33),
                    Field::make('text', 'apv_slider_advanced_settings_title', esc_html__('Title', 'apv-slider')) // phpcs:ignore
                        ->set_width(50)
                        ->set_conditional_logic(
                            array(
                            'relation' => 'AND',
                            array(
                            'field'   => 'apv_slider_advanced_settings_disable_title', // phpcs:ignore
                            'value'   => false,
                            'compare' => '=',
                            ),
                            )
                        ),
                    Field::make('select', 'apv_slider_advanced_settings_style', esc_html__('Styles', 'apv-slider')) // phpcs:ignore
                        ->set_width(50)
                        ->set_options(
                            array(
                            'style-1' => esc_html__('Style One', 'apv-slider'),
                            'style-2' => esc_html__('Style Two', 'apv-slider'),
                            )
                        ),
                    )
                );
        }

        /**
         * APV Slider Plugin Submenu Options function
         *
         * @return void
         */
        public function apvSliderPluginSubmenuOptions()
        {
            add_submenu_page(
                'apv-slider-options',
                esc_html__('Manage Slides', 'apv-slider'),
                esc_html__('Manage Slides', 'apv-slider'),
                'manage_options',
                'edit.php?post_type=apv-slider',
                null,
                null
            );

            add_submenu_page(
                'apv-slider-options',
                esc_html__('Add New Slide', 'apv-slider'),
                esc_html__('Add New Slide', 'apv-slider'),
                'manage_options',
                'post-new.php?post_type=apv-slider',
                null,
                null
            );
        }
    }
}
