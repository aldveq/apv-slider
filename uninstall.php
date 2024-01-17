<?php

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ):
    die;
endif;

$apv_options = array(
    'apv_slider_advanced_settings_disable_title',
    'apv_slider_advanced_settings_title',
    'apv_slider_advanced_settings_bullets',
    'apv_slider_advanced_settings_style'
); 

$apv_slider_posts = get_posts( array(
    'post_type' => 'apv-slider',
    'posts_per_page' => -1,
    'post_status' => 'any'
) );

foreach( $apv_options as $apv_option ):
    delete_option( $apv_option );
endforeach;

foreach ( $apv_slider_posts as $apv_post ):
    wp_delete_post( $apv_post->ID, true );
endforeach;
