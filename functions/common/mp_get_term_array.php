<?php
/**
 * NOTICE: 並び替えプラグインを使用しているため、orderbyが有効にならない。そこで一度配列で取得した後に並び替えしている
 * ターム一覧を取得する際、ソートが使えない場合の対応
 * 記事数が多い順に配列で取得する
 * 記事がない場合は取得しない
 *
 * @param (string|array) $taxonomis* タクソノミーのスラッグ
 * @return (array)
 */
function mp_get_term_array($taxonomis) {
  $term_array = [];
  $args = array(
    'hide_empty' => 0,
  );
  $terms = get_terms($taxonomis, $args);

  foreach ($terms as $term) {
    array_push($term_array, array(
      'name' => $term -> name,
      'slug' => $term -> slug,
      'count' => $term -> count,
    ));
  }

  $sort_key = array_column($term_array, 'count');
  array_multisort($sort_key, SORT_DESC, $term_array);
  
  return $term_array;
}