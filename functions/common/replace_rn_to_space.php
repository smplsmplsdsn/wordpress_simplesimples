<?php
/**
 * 改行コードをbrタグに変換する
 *
 * @param {string} $val
 * @return {string} brタグに変換された文字列
 */
function replace_rn_to_space($val = "") {
  $val = preg_replace('/\r\n/', '', $val);
  $val = preg_replace('/\r/', '', $val);
  $val = preg_replace('/\n/', '', $val);
  
  return $val;
}