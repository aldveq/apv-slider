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
			\Carbon_Fields\Carbon_Fields::boot();
		}
	}
endif;