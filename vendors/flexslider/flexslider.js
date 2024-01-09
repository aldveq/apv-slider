jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
		animation: "slide",
		touch: true,
		directionNav: false,
		smoothHeight: true,
		controlNav: Boolean( SLIDER_OPTIONS.isSliderBulletsDisabled ) ? false : true,
	});
});