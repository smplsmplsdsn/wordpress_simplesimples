<?php
/**
 * メディア設定以外での自動生成を停止
 * https://www.javadrive.jp/wordpress/media/index5.html
 */
function mp_media_not_auto_images() {
  
  return [];   // 空の配列を返却することで自動生成を停止する
}
//add_filter('intermediate_image_sizes_advanced', 'mp_media_not_auto_images');