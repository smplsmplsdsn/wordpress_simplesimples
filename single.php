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

// 投稿用テンプレートを呼び出す
switch (true) {
  case is_singular('moviereview'):
    header('Location: '.DOMAIN.'/moviereview/?movie_id='.get_the_id());    
    break;
    
  case is_singular('essay'):
  case is_singular('film'):
  case is_singular('photo'):
    $head_manifest = 'manifest-blog';
    $view_type = 'blog';
    include_once($theme_dir."/include/blog/single-".get_post_type_object(get_post_type()) -> name.".php");    
    break;    
    
  case is_singular('lyric'):
    include_once($theme_dir."/include/blog/lyric.php");    
    break;    
    
  default:
    $is_google_adsence = true;
    include_once($theme_dir."/include/post/single.php");    
}
