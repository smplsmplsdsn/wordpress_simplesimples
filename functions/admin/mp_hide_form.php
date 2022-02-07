<?php
/**
 * 本文エリアを非表示にする
 */
function mp_hide_form() {
  
  // カスタム投稿タイプ「lifequotes」のタイトルと本文エリアを非表示にする
  remove_post_type_support('lifequotes', 'title');
  remove_post_type_support('lifequotes', 'editor');
}
add_action('init', 'mp_hide_form');
