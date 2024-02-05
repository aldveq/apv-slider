<?php

/**
 * APV Slider Views Class
 *
 * This class defines the view of the slider
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

use WP_Query;

if (! class_exists('APVSliderViews') ) {
    /**
     * APV Slider Views class
     *
     * @category Plugins
     * @package  WordPress
     * @author   Aldo Paz Velasquez <aldveq80@gmail.com>
     * @license  GPL-2.0-or-later https://www.gnu.org/licenses/gpl-2.0.txt
     * @link     https://developer.wordpress.org/plugins/plugin-basics/
     * @see      APVSliderSingleton
     */
    class APVSliderViews extends APVSliderSingleton
    {
        /**
         * APV Slider Shortcode View function
         *
         * @param string $ids     Ids
         * @param string $orderby Order by
         * @param string $content Content
         *
         * @return void
         */
        public static function apvSliderShortcodeView( 
            $ids, 
            $orderby, 
            $content = null 
        ) {
            $apv_slider_title         = '';
            $apv_slider_title_option  = carbon_get_theme_option('apv_slider_advanced_settings_title'); // phpcs:ignore
            $apv_slider_title_disable = carbon_get_theme_option('apv_slider_advanced_settings_disable_title'); // phpcs:ignore
            $apv_slider_style         = null !== carbon_get_theme_option('apv_slider_advanced_settings_style') // phpcs:ignore
            && ! empty(carbon_get_theme_option('apv_slider_advanced_settings_style')) ? // phpcs:ignore
            carbon_get_theme_option('apv_slider_advanced_settings_style')
            : 'style-1';

            if (null !== $content
                && ! empty($content)
                && empty($apv_slider_title_option)
            ) :
                $apv_slider_title = $content;
         else :
             $apv_slider_title = $apv_slider_title_option;
         endif;
            ?>
            <?php
            if (! $apv_slider_title_disable ) :
                ?>
                <h3 
                    style="margin: 12px 0;"
                >
                <?php echo esc_html($apv_slider_title); ?>
                </h3>
                <?php
            endif;
            ?>
            <div class="mv-slider flexslider <?php echo esc_attr($apv_slider_style); // phpcs:ignore ?>">
                <ul class="slides">
            <?php
            $apv_slides_data = self::apvSliderGetSlides($ids, $orderby);

            foreach ( $apv_slides_data as $apv_slide_data ) :
                $apv_link_target = $apv_slide_data->link_target ? '_blank' : '_self';
                ?>
                        <li>
                <?php echo wp_kses_post($apv_slide_data->image); ?>
                            <div class="mvs-container">
                                <div class="slider-details-container">
                                    <div class="wrapper">
                                        <div class="slider-title">
                                            <h2>
                                            <?php echo esc_html($apv_slide_data->title); // phpcs:ignore ?>
                                            </h2>
                                        </div>
                                        <div class="slider-description">
                                            <?php 
                                            echo wp_kses_post(
                                                wpautop(
                                                    $apv_slide_data->description, 
                                                    true
                                                )
                                            ); 
                                            ?>
                                            <a 
                                                class="link" 
                                                href="<?php echo esc_url($apv_slide_data->link_url); // phpcs:ignore ?>" 
                                                target="<?php echo esc_attr($apv_link_target); // phpcs:ignore ?>"
                                            >
                                            <?php echo esc_html($apv_slide_data->link_title); // phpcs:ignore ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                <?php
            endforeach;
            ?>
                </ul>
            </div>
            <?php
        }

        /**
         * APV Slider Get Slides function
         *
         * @param string $ids     Ids
         * @param string $orderby Order by
         *
         * @return void
         */
        public static function apvSliderGetSlides( $ids, $orderby )
        {
            $apv_slides_post_data = array();

            $apv_slider_args = array(
            'post_type'   => 'apv-slider',
            'post_status' => 'publish',
            'post__in'    => $ids,
            'orderby'     => $orderby,
            );

            $apv_slider_query = new WP_Query($apv_slider_args);

            if ($apv_slider_query->have_posts() ) :
                while ( $apv_slider_query->have_posts() ) :
                    $apv_slider_query->the_post();

                    $apv_slide_obj = (object) array(
                    'image'       => get_the_post_thumbnail(
                        get_the_ID(),
                        'full',
                        array( 'class' => 'img-fluid' )
                    ),
                    'title'       => get_the_title(get_the_ID()),
                    'description' => get_the_content(get_the_ID()),
                    'link_title'  => carbon_get_post_meta(
                        get_the_ID(),
                        'slider_link_text'
                    ),
                    'link_url'    => carbon_get_post_meta(
                        get_the_ID(),
                        'slider_link_url'
                    ),
                    'link_target' => carbon_get_post_meta(
                        get_the_ID(),
                        'slider_link_target'
                    ),
                    );

                    array_push($apv_slides_post_data, $apv_slide_obj);
                endwhile;

                wp_reset_postdata();
            endif;

            return $apv_slides_post_data;
        }
    }
}
