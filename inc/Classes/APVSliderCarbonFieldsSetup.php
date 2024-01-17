<?php

/**
 * @package APV_Slider
 */

namespace APVSliderPlugin\Classes;

if (!class_exists('APVSliderCarbonFieldsSetup')) :
	class APVSliderCarbonFieldsSetup extends APVSliderSingleton
	{
		protected function __construct()
		{
			add_action( 'plugins_loaded', array($this, 'load_carbon_fields_library') );
		}

		public function load_carbon_fields_library() {
			\Carbon_Fields\Carbon_Fields::boot();
		}
	}
endif;