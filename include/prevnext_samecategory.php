<?php
/*
 * 投稿ページにて、同カテゴリーの前後記事の情報を取得する
 *
 * ATTENTION mp_html_list_unit.php を読み込んでいること
 */
$nextpost = get_adjacent_post(true, '', false);
$prevpost = get_adjacent_post(true, '', true);

if ($prevpost || $nextpost) {
?>
<nav class="prevnext js-prevnext">
  <div class="prevnext__inner">
<?php
  if ($prevpost) {
    echo mp_html_list_unit($prevpost -> ID, 50);
  } else {
    echo '<section class="prevnext__none">OLDEST</section>';
  }

  if ($nextpost) {
    echo mp_html_list_unit($nextpost -> ID, 50);
  } else {
    echo '<section class="prevnext__none">NEWEST</section>';
  }
?>
  </div>
</nav>
<?php  
}