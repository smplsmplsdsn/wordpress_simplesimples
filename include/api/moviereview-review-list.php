<?php
/**
 * WordPressの映画レビューを取得する
 */
$per = enc_param('per', $_GET, 30);
$pg = enc_param('pg', $_GET, 1);

$s = enc_param('query', $_GET, '');
$star = enc_param('star', $_GET, '');   // e.g., star=7,9
$genres = enc_param('genre', $_GET, '');
$runtime = enc_param('runtime', $_GET, '');
$release = enc_param('release', $_GET, '');  // e.g., 2010,2020
$countries = enc_param('country', $_GET, '');

function htmlReview() {
  
  $img_path = 'https://image.tmdb.org/t/p/w342'.get_field('review_tmdb_poster');
  $title = get_the_title();
  if (get_field('review_subtitle') != '') {
    $subtitle_coding = '<span>'.get_field('review_subtitle').'</span>';
  } else {
    $subtitle_coding = '';
  }
  
  if (get_field('review_tmdb_original_title') != get_the_title()) {
    $original_title_cording = '<p class="unit__original-title">'.get_field('review_tmdb_original_title').'</p>';    
  }
  
  
  $link = 'href="/moviereview/?movie_id='.get_the_id().'" data-id="'.get_the_id().'"';

  if (get_field('review_tmdb_runtime') != '' && get_field('review_tmdb_runtime') != '0') {
    $runtime = '<span class="unit__runtime">'.get_field('review_tmdb_runtime').'分</span>';
  } else {
    $runtime = '';
  }
  
  $genre_array = [];    
  if ($terms = get_the_terms(get_the_id(), 'tmdb_genres')) {
    foreach ( $terms as $term ) {
      array_push($genre_array, $term -> name);
    }
  }
  $genres = implode("・", $genre_array);
    
  return '
<article class="unit js-unit">
  <figure class="unit__figure" style="background-image:url('.$img_path.');"></figure>
  <div class="unit__text">
    <h1 class="unit__title"><a '.$link.'>'.$title.$subtitle_coding.'</a></h1>
    '.$original_title_cording.'
    <p>
      <span class="unit__star">★'.get_field('review_star').'</span>
      <span class="unit__release">'.get_field('review_tmdb_release_year').'</span>
      '.$runtime.'
    </p>
    <p class="unit__genre">'.$genres.'</p>
  </div>
</article>
  ';
}

$html = '';
$args = array(
  'post_type' => 'moviereview',
  'posts_per_page' => $per,
  'paged' => $pg,
);

// 検索ワードがある場合
if (trim($s) != '') {
  $args['s'] = $s;
}

// 時間比較がある場合
if ($runtime != '') {
  if (enc_param('meta_query', $args) == '') {
    $args['meta_query'] = [];
  }
  
  array_push($args['meta_query'], array(
    'relation' => 'AND',
    array(
      'key' => 'review_tmdb_runtime',
      'value' => (int) $runtime,
      'type' => 'UNSIGNED',
      'compare' => '<=',
    ),
    array(
      'key' => 'review_tmdb_runtime',
      'value' => 0,
      'type' => 'UNSIGNED',
      'compare' => '>',
    ),
  ));
}

// 満足度（スター）がある場合
// ATTENSION 時間比較の後に処理する必要あり
if ($star != 'all' && $star != '') {
  
  $star_array = explode(',', $star);
  
  if (enc_param('meta_query', $args) == '' && count($star_array) === 1) {
    $args['meta_key'] = "review_star";
    $args['meta_value'] = $star;    
  } else {
    if (enc_param('meta_query', $args) == '') {
      $args['meta_query'] = array(
        'relation' => 'AND',
      );
    }

    if (count($star_array) === 1) {
      array_push($args['meta_query'], array(
        array(
          'key' => 'review_star',
          'value' => (int) $star,
          'type' => 'UNSIGNED',
          'compare' => '=',
        ),
      ));
      
    } else {
      array_push($args['meta_query'], array(
        array(
          'key' => 'review_star',
          'value' => min($star_array[0], $star_array[1]),
          'type' => 'UNSIGNED',
          'compare' => '>=',
        ),
        array(
          'key' => 'review_star',
          'value' => max($star_array[0], $star_array[1]),
          'type' => 'UNSIGNED',
          'compare' => '<=',
        ),
      ));      
    }
  }
}

// 公開年がある場合
// ATTENSION 時間比較の後に処理する必要あり
if ($release != '') {
  
  $release_array = explode(',', $release);
  
  if (enc_param('meta_query', $args) == '' && count($release_array) === 1) {
    $args['meta_key'] = "review_tmdb_release_year";
    $args['meta_value'] = $release;    
  } else {
    if (enc_param('meta_query', $args) == '') {
      $args['meta_query'] = array(
        'relation' => 'AND',
      );
    }

    if (count($release_array) === 1) {
      array_push($args['meta_query'], array(
        array(
          'key' => 'review_tmdb_release_year',
          'value' => (int) $release,
          'type' => 'UNSIGNED',
          'compare' => '=',
        ),
      ));
      
    } else {
      array_push($args['meta_query'], array(
        array(
          'key' => 'review_tmdb_release_year',
          'value' => min($release_array[0], $release_array[1]),
          'type' => 'UNSIGNED',
          'compare' => '>=',
        ),
        array(
          'key' => 'review_tmdb_release_year',
          'value' => max($release_array[0], $release_array[1]),
          'type' => 'UNSIGNED',
          'compare' => '<=',
        ),
      ));      
    }
  }
}


// ジャンル指定がある場合（AND検索）
if ($genres != '') {
  $genre_array = explode(',', $genres);
  
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'tmdb_genres',
      'field' => 'slug',
      'terms' => $genre_array,
      'include_children' => true,
      'operator' => 'AND',
    )
  );  
}

// 制作国がある場合（OR検索）
if ($countries != '') {
  $country_array = explode(',', $countries);
  
  if (enc_param('tax_query', $args) == '') {
    $args['tax_query'] = array(
      'relation' => 'AND',
    );
  }
  
  array_push($args['tax_query'], array(
    'taxonomy' => 'tmdb_countries',
    'field' => 'slug',
    'terms' => $country_array,
    'include_children' => true,
    'operator' => 'IN',
  ));
}

$the_query = new WP_Query($args);
$total_num = $the_query->found_posts;
$id_array = [];
if ($the_query->have_posts()):
while ($the_query->have_posts()): $the_query->the_post();
  $html .= htmlReview(get_the_id());
  array_push($id_array, get_the_id());
endwhile;
endif;
wp_reset_query();

// 検索ワードがある場合、検索対象を変更して再検索する
// ATTENSION カスタムフィールドをデフォルト検索対象（タイトルや本文など）とOR検索できないため
// ATTENSION ORとANDは共存できないため、他の条件があるときは追加検索はしない
if (enc_param('s', $args) != '' && enc_param('meta_query', $args) == '') {
  unset($args['s']);
  
  $args['meta_query'] = array(
    'relation' => 'OR',
    array(
      'key' => 'review_subtitle',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_title_en',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_subtitle_en',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_title',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_original_title',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_overview',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_cast',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_director',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
    array(
      'key' => 'review_tmdb_screenplay',
      'value' => $s,
      'type' => 'CHAR',
      'compare' => 'LIKE'
    ),
  );

  $the_query = new WP_Query($args);
  $total_num = $total_num + $the_query->found_posts;
  if ($the_query->have_posts()):
  while ($the_query->have_posts()): $the_query->the_post();
    if (!in_array(get_the_id(), $id_array)) {
      $html .= htmlReview(get_the_id());
    }
  endwhile;
  endif;
}

/*
 * MOREとページ表示
 */
if ($html != '') {
  $html .= '<p class="pager js-pager">';

  // 検索結果がまだある場合、MOREリンクを表示する
  if ($per*$pg < $total_num) {
    $request_uri = $_SERVER['REQUEST_URI'];
    $request_uri = parse_url($request_uri, PHP_URL_QUERY);
    parse_str($request_uri, $request_uri_array);
    $request_uri_array['pg'] = (int) $pg + 1;

    $html .= '
  <a class="pager__more js-page-more" data-next="/api/?'.http_build_query($request_uri_array).'">MORE</a>
    ';
  }

  // 現在表示している情報
  $pager_start = ($pg - 1)*$per;
  $pager_end = min($per*$pg, $total_num);

  if ($pager_end != 0 && $s == '') {
    $html .= '<span class="pager__status">1<span class="pager__status-bar">-</span>'.$pager_end.'<span class="pager__status-bar">/</span><span class="js-total-num">'.$total_num.'</span></span>';
  }

  $html .= '</p>';  
} else {
  $html = 'zero';
}

echo $html;



