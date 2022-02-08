<?php
/**
 * 第4階層までのディレクトリ名を取得する
 *
 * @num {number} $num: 指定した階層のディレクトリ名を取得する
 * @return {array|string} 階層指定がある場合はその階層のディレクトリ名、それ以外はディレクトリ名の配列
 */
function get_dir($num = 0) {
//  $dir = param('path', parse_url(REQUEST_URI));  
  $dir = explode('?', $_SERVER['REQUEST_URI']);
  $dir = $dir[0];
  $dir_array = explode('/', $dir);
  
  return ($num > 0)? $dir_array[$num]: $dir_array;
}
