<?php
/**
 * アップロード画像先をユーザーごとにディレクトリ分けする
 * https://510052.xyz/posts/493d1b94t8wk3o84w575/
 *
 * ATTENTION WordPressの設定 > メディア アップロードしたファイルを年月ベースのフォルダーに整理のチェックを外しておく 
 */
function mp_media_author_dir($upload) {
  global $current_user;
  $upload['subdir'] = "/users/" . $current_user->ID;
  $upload['path'] .= $upload['subdir'];
  $upload['url'] .= $upload['subdir'];
  return $upload;
}
add_filter('upload_dir', 'mp_media_author_dir');