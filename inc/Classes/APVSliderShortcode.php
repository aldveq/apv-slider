<?php

/**
 * @package APV_Slider
 */

namespace APVSliderPlugin\Classes;

if (!class_exists('APVSliderShortcode')) :
	class APVSliderShortcode extends APVSliderSingleton
	{
		protected function __construct()
		{
			add_action('init', array($this, 'apv_slider_shortcode_setup'));
		}

		public function apv_slider_shortcode_setup() {
			add_shortcode( 'apv_slider', array( $this, 'apv_slider_shortcode' ) );
		}

		public function apv_slider_shortcode( $atts = array(), $content = null, $tag = '' ) {
			// Making all attributes lower caase
			$atts = array_change_key_case( (array) $atts, CASE_LOWER );

			// Extracting every single shortcode attribute to handle it by case
			extract( shortcode_atts(
				array(
					'ids' => '',
					'orderby' => 'date'
				),
				$atts,
				$tag
			) );

			// Making sure ids are positive integer values
			if ( !empty( $ids ) ):
				$ids = array_map( 'absint', explode( ',', $ids ) );
			endif; 

			ob_start();
			APVSliderViews::apv_slider_shortcode_view( $ids, $orderby, $content );
			wp_enqueue_script( 'apv-slider-flexslider-src-script' );
			wp_enqueue_script( 'apv-slider-flexslider-script' );
			wp_enqueue_style( 'apv-slider-flexslider-src-styles' );
			wp_enqueue_style( 'apv-slider-flexslider-styles' );
			return ob_get_clean();
		}
	}
endif;
