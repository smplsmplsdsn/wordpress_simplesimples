<?php
/*
 * 投稿ページにて、前後記事の情報を取得する
 *
 * mp_html_list_unit.php を読み込んでいること
 */
$nextpost_all = get_adjacent_post(false, '', false);
$prevpost_all = get_adjacent_post(false, '', true);

if ($nextpost_all || $prevpost_all) {
  if ($prevpost_all) {
    echo mp_html_list_unit($prevpost_all -> ID, 50);
  } else {
    echo '<section class="prevnext__none">OLDEST</section>';
  }

  if ($nextpost_all) {
    echo mp_html_list_unit($nextpost_all -> ID, 50);
  } else {
    echo '<section class="prevnext__none">NEWEST</section>';
  }
}