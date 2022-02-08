<?php
/**
 * 改行コードをbrタグに変換する
 *
 * @param {string} $val
 * @return {string} brタグに変換された文字列
 */
function replace_br($val = "") {
  $val = preg_replace('/\r\n/', '<br>', $val);
  $val = preg_replace('/\r/', '<br>', $val);
  $val = preg_replace('/\n/', '<br>', $val);
  
  return $val;
}