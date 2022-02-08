<?php
/**
 * 連想配列の指定したキーが配列にあるかどうかを調べて、あればその値を返却
 * 利用条件：enc.phpを読み込んでいること
 *
 * @param {string|number} $key 取得したい値のキー
 * @param {array} $ary 取得したい値のキーを含む配列
 * @param {string|null} $def $aryに対する$keyが存在しない場合の返却デフォルト値
 * @return {string|number}
 */
function enc_param($key = null, $ary = [], $def = '') {
  return ('array' == gettype($ary) && array_key_exists($key, $ary) && '' != $ary[$key])? enc($ary[$key]): $def; 
}
