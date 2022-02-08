<?php
/*

// アクセスするごとに24時間有効なクッキーを作る場合
setcookie('name', 'value', time() + 24*60*60);

// セッションがあれば、それを利用し、なければセッションを発行する場合
if (isset($_SESSION['name'])) {
  $session_key = $_SESSION['name'];
} else {
  $session_key = md5(md5(time()).'value');
  $_SESSION['name'] = $session_key;
}
*/
// WordPressのテンプレートパス
$theme_dir = get_template_directory();

// お手製のPHPファイルを読み込む
include_once($theme_dir."/functions/index.php");


switch (true) {
  case is_post_type_archive('api'):
    include_once($theme_dir."/include/api/index.php");
    break;

  case is_post_type_archive('moviereview'):
    $head_manifest = 'manifest-moviereview';
    include_once($theme_dir."/include/post/moviereview.php");
    break;

  case is_post_type_archive('essay'):
  case is_post_type_archive('film'):
  case is_post_type_archive('photo'):
    $head_manifest = 'manifest-blog';
    $view_type = 'blog';
    include_once($theme_dir."/include/post/archive-".get_post_type_object(get_post_type()) -> name.".php");    
    break;

  case is_post_type_archive('lyric'):
    include_once($theme_dir."/include/post/lyric.php");    
    break;
    
  default:
    echo '404';
}
