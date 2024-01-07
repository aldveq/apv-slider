<?php

/**
 * @package APV_Slider
 */

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;

if (!class_exists('APV_Carbon_Fields_Setup')) :
	class APV_Carbon_Fields_Setup
	{
		use Singleton;

		protected function __construct()
		{
			\Carbon_Fields\Carbon_Fields::boot();
		}
	}
endif;