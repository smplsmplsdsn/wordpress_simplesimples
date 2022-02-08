<?php
/**
 * 文字列エンコード
 *
 * @param {string} $t
 * @return {string} エンコードされた文字列
 */
function enc($t = '') {
  return (gettype($t) === 'string')? htmlspecialchars($t, ENT_QUOTES, 'UTF-8'): $t;
}