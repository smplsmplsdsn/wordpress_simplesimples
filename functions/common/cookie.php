<?php
/*
* cookieセット
* http://php.net/manual/ja/function.setcookie.php
*
* 第2引数がない場合は、削除として機能する
*
* (事前定義が必要) COOKIE_DOMAIN_NAME
*
* @param {string} $key クッキーの名前
* @param {string} $val クッキーの値
* @param {string} $path クッキーを有効としたいパス（デフォルトはドメイン配下すべてを対象）
*/
function cookie($key = '', $val = '', $path = "/") {
    
  // https確認
  $is_https = (empty($_SERVER["HTTPS"]))? false: true;

  // 90日間保持
  $expire = time() + 60*60*24*90;
  
  // 10分保持（ローカル環境 http://{xxx}.localhost の場合）
  if (!$is_honban) {
    $expire = time() + 600;    
  }

  // 一時無効にする
  setcookie($key, '', time() - 3600, $path, COOKIE_DOMAIN_NAME, $is_https, true);

  // 削除か更新をおこなう
  if ("" === $val) {
    unset($_COOKIE[$key]);
  } else {
    setcookie($key, $val, $expire, $path, COOKIE_DOMAIN_NAME, $is_https, true);
  }
}
