<?php
/*
 * 記事詳細情報を取得する
 *
 * @param (string) movie_id* 記事ID
 *
 * @return json形式のレビュー情報
 *
 * プロフィール画像サイズ
 * https://qiita.com/kokogento/items/00ffed5c81cdd44cf85b
 */
header("Content-Type: application/json; charset=utf-8");

$post_id = enc_param('movie_id', $_GET);
$post_array = [];

if ($post_id === '') {
  echo '{}';
  die();
}

// 全記事を更新する場合
$args = array(
  'post_type' => 'moviereview',
  'p' => $post_id,
);

$the_query = new WP_Query($args);
if ($the_query->have_posts()):
while ($the_query->have_posts()): $the_query->the_post();
  $genre_array = [];    
  if ($terms = get_the_terms(get_the_id(), 'tmdb_genres')) {
    foreach ($terms as $term) {
      array_push($genre_array, array(
        'name' => $term -> name,
        'slug' => $term -> slug, 
      ));
    }
  }

  $country_array = [];
  if ($terms = get_the_terms(get_the_id(), 'tmdb_countries')) {
    foreach ($terms as $term) {
      array_push($country_array, array(
        'name' => $term -> name,
        'slug' => $term -> slug, 
      ));
    }
  }

  $post_array = array(
    'id' => get_the_id(),
    'title' => get_the_title(),
    'content' => get_the_content(),
    'date' => get_the_date('Y-m-d'),
    'update' => get_the_modified_date('Y-m-d'),
    'subtitle' => get_field('review_subtitle'),
    'genre' => $genre_array,
    'country' => $country_array,
    'amazon_id' => get_field('review_amazon_id'),
    'amazon_poster' => get_field('review_img'),
    'star' => get_field('review_star'),
    'youtube' => get_field('review_youtube'),
    'tmdb_id' => get_field('review_tmdb_id'),
    'tmdb_title' => get_field('review_tmdb_title'),
    'tmdb_original_title' => get_field('review_tmdb_original_title'),
    'tmdb_poster' => get_field('review_tmdb_poster'),
    'tmdb_overview' => get_field('review_tmdb_overview'),
    //'tmdb_release' => get_field('review_tmdb_release'),
    'tmdb_release' => get_field('review_tmdb_release_year'),
    'tmdb_runtime' => get_field('review_tmdb_runtime'),
    'tmdb_vote_average' => get_field('review_tmdb_vote_average'),
    'tmdb_vote_count' => get_field('review_tmdb_vote_count'),
    'tmdb_cast' => json_decode(get_field('review_tmdb_cast')),
    'tmdb_director' => json_decode(get_field('review_tmdb_director')),
    'tmdb_screenplay' => json_decode(get_field('review_tmdb_screenplay')),
    'tmdb_type' => get_field('review_tmdb_type'),
  );

endwhile;
endif;
wp_reset_query();

echo json_encode($post_array);

