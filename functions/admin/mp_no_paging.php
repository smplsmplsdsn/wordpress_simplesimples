<?php
/**
 * カテゴリページもしくはアーカイブページ、検索結果ページにて全件表示する
 * https://qiita.com/tamura_masa/items/b6d1019376a58ae1b612
 */
function mp_no_paging($query) {
  if (!is_admin() && $query -> is_main_query() && (is_category() || is_archive() || is_search())) {
    $query->set('nopaging', 1);
  }
}
add_action('pre_get_posts', 'mp_no_paging');