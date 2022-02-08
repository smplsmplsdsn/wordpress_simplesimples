<?php
/**
 * 日本語が使える環境か確認する
 * http://kotori-blog.com/php/globalaccess/
 *
 * @return {boolean} 日本語が使えるかどうか
 */
function is_lang_ja() {
  $is_ja = false;
  $accept_language = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
  foreach ($accept_language as $language) {
    if (preg_match('/^ja/i', $language)) {
      $is_ja = true;
      break;
    }
  }
  return $is_ja;
}
