jQuery(window).load(function () {
	jQuery('.flexslider').flexslider({
		animation: "slide",
		touch: true,
		directionNav: Boolean(SLIDER_OPTIONS.isSliderNavArrowsDisabled) ? false : true,
		smoothHeight: true,
		controlNav: Boolean(SLIDER_OPTIONS.isSliderBulletsDisabled) ? false : true,
	});
});