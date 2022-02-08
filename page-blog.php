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

include_once($theme_dir."/include/blog/page-blog.php");