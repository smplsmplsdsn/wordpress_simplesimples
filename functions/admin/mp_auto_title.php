<?php
/**
 * タイトルが空のときにタイトルを自動でつける → 言葉のときのタイトルは自動上書きする
 * https://moralhazard.jp/2014/05/02/wordpress%E3%81%A7%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E3%82%92%E7%A9%BA%E7%99%BD%E3%81%A7%E6%8A%95%E7%A8%BF%E3%81%97%E3%81%9F%E6%99%82%E3%81%AB%E3%80%81%E8%87%AA%E5%8B%95%E7%9A%84%E3%81%AB%E3%82%BF/
 */
function mp_auto_title($title) {
  global $post;
  
  //post_typeを判定(post, page, カスタム投稿)
  if ($post -> post_type == 'lifequotes') {
    // if ($title == "") {}
    $title = 'p'.time();
  }
  return $title;
}
add_filter('title_save_pre', 'mp_auto_title');
