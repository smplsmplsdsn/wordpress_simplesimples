<?php
/**
 * 参照元が指定ドメインと一致するか判別する
 *
 * @param {string} $url_host: 指定するURLと一致するか確認する
 * @return {boolean} 参照元が一致するかどうか
 */
function is_referer_domain($url_host = "参照元のURLと比較するURL") {
  return isset($_SERVER['HTTP_REFERER']) && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) == $url_host;
}
