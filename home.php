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

$head_ogp_img = ASSETS_PATH.'/ogp.png';
$head_title = "Web制作・映像撮影編集ならシンプルシンプルデザイン";
$head_description = "個人向け、中小企業向け、新事業向けのWeb制作や映像撮影、編集をしています。";
$view_type = 'simplesimples';

switch (true) {    
  case (enc_param('content', $_GET) != ''):
    $file_type = 'content/'.enc_param('content', $_GET).'.php';
    break;
    
  case (enc_param('event', $_GET) != ''):
    $file_type = 'event/'.enc_param('event', $_GET).'.php';
    break;
    
  case (enc_param('special', $_GET) != ''):
    $file_type = 'special/'.enc_param('special', $_GET).'.php';
    break;
    
  default:
    $file_type = 'home.php';
}

if (file_exists($theme_dir."/include/".$file_type)) {
  include_once($theme_dir."/include/".$file_type);  
}
