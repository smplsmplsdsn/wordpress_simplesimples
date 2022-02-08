<?php
/**
 * 外部ファイルが存在するか判別する
 * ATTENSION 読み込みに時間がかかるため、極力利用しない
 *
 * @param (string) $url* httpから始まるパス
 * @return (boolean)
 */
function is_file_exsist($url) {
  $headers = get_headers($url);
  if (is_array($headers) && count($headers) > 0) {
    if(strpos($headers[0], 'OK')) {
      return true;
    }
  }
  return false;
}
