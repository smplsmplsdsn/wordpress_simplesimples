<?php
// ログインしているか判別する
if (!is_user_logged_in()) {
  die();
}

// 管理者権限か判別する
if (!current_user_can('manage_options')) {
  die();
}

$post_id = enc_param('post_id', $_POST);
$movie_title = enc_param('movie_title', $_POST);

$param = [];
$r = 0;

// 新規登録か判別する
if ($post_id === '' && $movie_title != '') {
  $param['post_title'] = $movie_title;
  $param['post_type'] = 'moviereview';
  $param['post_status'] = 'draft';
  $r = wp_insert_post($param);    // post_id 失敗した場合は「0」
} elseif ($post_id != '') {
  
  if ($movie_title != '') {
    $param['ID'] = $post_id;
    $param['post_title'] = $movie_title;
    $r = wp_update_post($param);
  }
  
  if (update_post_meta($post_id, 'review_youtube', $_POST['youtube'])) {
    $r = $post_id;
  }
  
  if (update_post_meta($post_id, 'review_amazon_id', $_POST['amazon'])) {
    $r = $post_id;
  }
}

echo $r;