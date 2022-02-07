<?php
session_start();

date_default_timezone_set('Asia/Tokyo');  // サーバーサイドは日本時間を基準にする

// 本番のドメイン（$_SERVER['HTTP_HOST'] の値）
$http_host = "simplesimples.com";

// ドメイン
$domain_name = $_SERVER['SERVER_NAME'];

// cookie用ドメイン
define("COOKIE_DOMAIN_NAME", $domain_name);

// 公開パスとルートパス
$template_path = get_bloginfo('template_directory');    // WordPressタグ
define("ASSETS_PATH", $template_path.'/assets');
define("ASSETS_LOOT", dirname(__FILE__).'/../assets');

// ドメイン e.g., http//localhost:8888/
$http_or_https = ($_SERVER['HTTPS'] === 'on')? 'https': 'http';
$domain = $http_or_https.'://'.$domain_name;
define("DOMAIN", $domain);

// 本番環境かつプレビュー画面でないことを確認
$is_honban = ($http_host === $_SERVER['HTTP_HOST'] && (strpos($_SERVER['REQUEST_URI'],'/?preview') === false))? true: false;

// 本番以外ではエラーを表示する
$is_error_display = ($is_honban)? 0: 1;
ini_set('display_errors', $is_error_display);

// common 直下のphpファイルをすべてて呼び出す
foreach (glob(dirname(__FILE__).'/common/{*.php}',GLOB_BRACE) as $file) {
  if (is_file($file)) {
    include_once($file);
  }
}

// original 直下のphpファイルをすべてて呼び出す
foreach (glob(dirname(__FILE__).'/original/{*.php}',GLOB_BRACE) as $file) {
  if (is_file($file)) {
    include_once($file);
  }
}
