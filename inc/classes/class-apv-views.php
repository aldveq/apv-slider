<?php

/**
 * @package APV_Slider
 */

namespace APV_Slider\Inc;
use APV_Slider\Inc\Traits\Singleton;
use \WP_Query;

if (!class_exists('APV_Views')) :
	class APV_Views
	{
		use Singleton;

		public static function apv_slider_shortcode_view($ids, $orderby, $content =  null ) {
			$apv_slider_title = '';
			$apv_slider_title_option = carbon_get_theme_option( 'apv_slider_advanced_settings_title' ); 

			if ( null !== $content 
				&& !empty( $content ) 
				&& empty( $apv_slider_title_option )):
				$apv_slider_title = $content;
			else: 
				$apv_slider_title = $apv_slider_title_option;
			endif;
			?>
				<h3><?php echo esc_html($apv_slider_title); ?></h3>
				<div class="mv-slider flexslider">
					<ul class="slides">
						<?php
							$apv_slides_data = self::apv_slider_get_slides($ids, $orderby);

							foreach ($apv_slides_data as $apv_slide_data):
								$apv_link_target = $apv_slide_data->link_target ? '_blank' : '_self';
								?>
								<li>
									<?php echo wp_kses_post($apv_slide_data->image); ?>
									<div class="mvs-container">
										<div class="slider-details-container">
											<div class="wrapper">
												<div class="slider-title">
													<h2><?php echo esc_html($apv_slide_data->title); ?></h2>
												</div>
												<div class="slider-description">
													<!--Apply the subtitle css classname to all p tags later on-->
													<?php echo wp_kses_post(wpautop($apv_slide_data->description, true)); ?>
													<a 
														class="link"
														href="<?php echo esc_url($apv_slide_data->link_url); ?>"
														target="<?php echo esc_attr($apv_link_target); ?>"
													>
														<?php echo esc_html($apv_slide_data->link_title); ?>
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

		public static function apv_slider_get_slides($ids, $orderby) {
			$apv_slides_post_data = array();

			$apv_slider_args = array(
				'post_type' => 'apv-slider',
				'post_status' => 'publish',
				'post__in' => $ids,
				'orderby' => $orderby
			);

			$apv_slider_query = new WP_Query($apv_slider_args);

			if ( $apv_slider_query->have_posts() ):
				while( $apv_slider_query->have_posts() ):
					$apv_slider_query->the_post();

					$apv_slide_obj = (object) array(
						'image' => get_the_post_thumbnail(
							get_the_ID(),
							'full', 
							array( 'class' => 'img-fluid' ) 
						),
						'title' => get_the_title( get_the_ID() ),
						'description' => get_the_content( get_the_ID() ),
						'link_title' => carbon_get_post_meta( 
							get_the_ID(), 
							'slider_link_text'
						),
						'link_url' => carbon_get_post_meta(
							get_the_ID(),
							'slider_link_url' 
						),
						'link_target' => carbon_get_post_meta(
							get_the_ID(),
							'slider_link_target' 
						),
					);

					array_push( $apv_slides_post_data, $apv_slide_obj );
				endwhile;

				wp_reset_postdata();
			endif;


			return $apv_slides_post_data;
		}
	}
endif;
