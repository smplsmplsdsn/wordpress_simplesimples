<?php
/**
 * WordPress Popular Postsをカスタマイズ
 * https://blog-and-destroy.com/1270
 */
function mp_wpp_custom_html($mostpopular, $instance){
	$output = '';

	foreach($mostpopular as $popular){
		$output .= mp_get_post_for_list($popular -> id);
		// esc_html( $popular->pageviews ).'views'; 
	}

	return $output;
}
add_filter('wpp_custom_html', 'mp_wpp_custom_html', 10, 2);
