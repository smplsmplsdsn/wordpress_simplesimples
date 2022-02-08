<?php
/**
 * e.g.
 * simplesimples.com/api/?class=sonycamera
 */
$api_file = $theme_dir."/include/api/".enc_param('class', $_GET, 'nothing').".php";
if (is_file($api_file)) {
  include_once($api_file);
} else {
  echo '404';
}
