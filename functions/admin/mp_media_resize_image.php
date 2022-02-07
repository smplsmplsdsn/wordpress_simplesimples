<?php
/**
 * フルサイズの画像をリサイズする
 * https://www.websuccess.jp/blog/archives/2134/
 */
function mp_media_resize_image($file) {
 
	if ($file['type'] == 'image/jpeg' || 
      $file['type'] == 'image/gif' || 
      $file['type'] == 'image/png') {
 
		$w = 1600;
		$h = 1600;
 
		$image = wp_get_image_editor($file['file']);
 
		if (!is_wp_error( $image )) {
			$size = getimagesize($file['file']);
 
			if ($size[0] > $w || $size[1] > $h) {
				$image -> resize( $w, $h, false );
				$final_image = $image -> save($file['file']);
			}
		}
	}
	return $file;
}
add_action('wp_handle_upload', 'mp_media_resize_image');
