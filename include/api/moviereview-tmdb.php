<?php
/**
 * 記事情報のカスタムフィールドにTMDB APIで取得した情報をセットする
 *
 * @get_param {string} tid* TMDB id
 * @get_param {string} pid* 記事を上書きする場合は、記事IDを指定する
 */
include_once('_config.php');

// GETパラメータを確認する
$post_id = enc_param('pid', $_GET, '');   // 投稿 ID
$tmdb_id = enc_param('tid', $_GET, '');   // TMDB ID
$tmdb_type = enc_param('type', $_GET, 'movie');    // TMDBタイプ

// ログインしているか判別する
if (!is_user_logged_in()) {
  die();
}


/**
 * 記事の上書き
 * $valueがNULLの場合は空文字をセットする
 * (param情報 割愛）
 */
function mp_update_post_meta($post_id, $key, $value = '') {
  update_post_meta($post_id, $key, $value);
}

/**
 * プロフィール写真を取得する
 * MEMO /credits/ で取得できない場合、/person/ で取得できる場合がある
 */
function get_profie($person_id, $profile_path = NULL) {
  if ($person_id && !$profile_path) {
    $url = 'https://api.themoviedb.org/3/person/'.$person_id.'?api_key='.TMDB_APIKEY.'&language=ja';
    $content = @file_get_contents($url);
    if ($content) {
      $json = json_decode($content, false);      
      $profile_path = $json -> profile_path;
    }
  } 
  return $profile_path;
}

/**
 * 概要文が空の場合、英語で取得できる場合がある
 *
 * @param (string) $url 英語版APIのURL
 * @return (string) 概要文
 */
function get_overview($url) {
  $overview = '';
  
  $content = @file_get_contents($url);
  if ($content) {
    $json = json_decode($content, false);
    $overview = $json -> overview;
  }
  return $overview;
}

/**
 * 映画情報を取得する
 *
 * @param 整数 $tmdb_id* TMDBの作品ID
 * @param 整数 $post_id 記事を更新する場合は記事ID
 */
function info_tmdb($tmdb_id, $post_id = '', $tmdb_type) {
  
  /*
   * TMDB API movie にアクセスして作品の概要情報を取得する
   */
  if ($tmdb_type == 'tv') {
    $url = 'https://api.themoviedb.org/3/tv/'.$tmdb_id.'?api_key='.TMDB_APIKEY;  
  } else {
    $url = 'https://api.themoviedb.org/3/movie/'.$tmdb_id.'?api_key='.TMDB_APIKEY;    
  }
  
  $content = @file_get_contents($url.'&language=ja');
  if ($content) {
    $json = json_decode($content, false);
  }
    
  // データがあるか判別する
  if (isset($json) && $json -> id) {
       
    $tmdb_genres_array = [];
    if (gettype($json -> genres) === 'array') {
      foreach ($json -> genres as $genre) {        
        array_push($tmdb_genres_array, (string) $genre -> id);
      }
    }
    $tmdb_id = $json -> id;
    $tmdb_original_title = $json -> original_title;
    $tmdb_poster = $json -> poster_path;
    
    $tmdb_overview = $json -> overview;
    if (!$tmdb_overview || $tmdb_overview == '') {
      $tmdb_overview = get_overview($url.'&language=en-US');
    }
    
    $tmdb_countries_array = [];
    if (gettype($json -> production_countries) === 'array') {
      foreach ($json -> production_countries as $country) {
        foreach ($country as $k => $v) {
          if (preg_match("/^iso/i", $k)) {
            array_push($tmdb_countries_array, $v);
            break 2;
          }
        }
      }
    }
    
    $tmdb_release_date = $json -> release_date;
    
    if ($tmdb_release_date) {
      $tmdb_release_date_year = (explode('-', $tmdb_release_date))[0];
    } else {
      $tmdb_release_date_year = NULL;
    }
    
    $tmdb_runtime = $json -> runtime;
    if (gettype($tmdb_runtime) === 'array') {
      if (preg_match('/^[0-9]+$/', $tmdb_runtime[0])) {
        $tmdb_runtime = $tmdb_runtime[0];        
      } else {
        $tmdb_runtime = NULL;        
      }
    }
    
    if ($json -> title) {
      $tmdb_title = $json -> title;      
    } else if ($json -> name) {
      $tmdb_title = $json -> name;    
    }
  
    $tmbd_vote_average = $json -> vote_average;
    $tmbd_vote_count = $json -> vote_count;
        
    // wordpressの更新か判別する
    if ($post_id != '') {
      mp_update_post_meta($post_id, 'review_tmdb_id', $tmdb_id);
      mp_update_post_meta($post_id, 'review_tmdb_title', $tmdb_title);
      mp_update_post_meta($post_id, 'review_tmdb_original_title', $tmdb_original_title);
      mp_update_post_meta($post_id, 'review_tmdb_poster', $tmdb_poster);
      mp_update_post_meta($post_id, 'review_tmdb_overview', $tmdb_overview);
      mp_update_post_meta($post_id, 'review_tmdb_release', $tmdb_release_date);
      mp_update_post_meta($post_id, 'review_tmdb_release_year', $tmdb_release_date_year);
      mp_update_post_meta($post_id, 'review_tmdb_runtime', $tmdb_runtime);
      mp_update_post_meta($post_id, 'review_tmdb_vote_average', $tmbd_vote_average);
      mp_update_post_meta($post_id, 'review_tmdb_vote_count', $tmbd_vote_count);
      mp_update_post_meta($post_id, 'review_tmdb_type', $tmdb_type);

      if (count($tmdb_genres_array) > 0) {
        wp_set_object_terms($post_id, $tmdb_genres_array, 'tmdb_genres');
      }

      if (count($tmdb_countries_array) > 0) {
        wp_set_object_terms($post_id, $tmdb_countries_array, 'tmdb_contries');
      }
    }
  }

  
  /*
   * TMDB API movie にアクセスして出演者・スタッフ情報を取得する
   */
  if ($tmdb_type == 'tv') {
    $url = 'https://api.themoviedb.org/3/tv/'.$tmdb_id.'/credits?api_key='.TMDB_APIKEY.'&language=ja';
  } else {
    $url = 'https://api.themoviedb.org/3/movie/'.$tmdb_id.'/credits?api_key='.TMDB_APIKEY.'&language=ja';
  }
  
  $content = @file_get_contents($url);
  if ($content) {
    $json = json_decode($content, false);  
  }
      
  // データがあるか判別する
  if (isset($json) && $json -> id) {
       
    $tmdb_cast_array = [];
    $tmdb_director_array = [];
    $tmdb_screenplay_array = [];
    
    if (gettype($json -> cast) === 'array') {
      $i = 0;
      foreach($json -> cast as $cast) {
        if ($i < 10) {
          array_push($tmdb_cast_array, array(
            'id' => $cast -> id,
            'name' => $cast -> name,
            'profile' => get_profie($cast -> id, $cast -> profile_path),
            'character' => $cast -> character,
          ));
          $i++;
        } else {
          break;
        }
      }
    }
    
    if (gettype($json -> crew) === 'array') {
      foreach($json -> crew as $crew) {
        
        if ($crew -> job === 'Director') {
          array_push($tmdb_director_array, array(
            'id' => $crew -> id,
            'name' => $crew -> name,
            'profile' => get_profie($crew -> id, $crew -> profile_path),
            'popularity' => $crew -> popularity,
          ));
        } elseif ($crew -> job === 'Screenplay') {
          array_push($tmdb_screenplay_array, array(
            'id' => $crew -> id,
            'name' => $crew -> name,
            'profile' => get_profie($crew -> id, $crew -> profile_path),
            'popularity' => $crew -> popularity,
          ));
        }
      }
      
      // screenplay をポピュラー順に並び替える
      $ids = array_column($tmdb_screenplay_array, 'id');
      array_multisort($ids, SORT_DESC, $tmdb_screenplay_array);
    }
    
    // 配列をjson形式の文字列に変換する
    $tmdb_cast = json_encode($tmdb_cast_array);
    $tmdb_director = json_encode($tmdb_director_array);    
    $tmdb_screenplay = json_encode($tmdb_screenplay_array);
        
    // wordpressの更新か判別する
    if ($post_id != '') {
      update_post_meta($post_id, 'review_tmdb_cast', $tmdb_cast);
      update_post_meta($post_id, 'review_tmdb_director', $tmdb_director);
      update_post_meta($post_id, 'review_tmdb_screenplay', $tmdb_screenplay);
    }
  }
}

// 作品IDがあるか判別する
if ($tmdb_id != '') {
  info_tmdb($tmdb_id, $post_id, $tmdb_type);
} else {
  
  
  // 全記事を更新する場合
  /*
  $args = array(
    'post_type' => 'moviereview',
    'posts_per_page' => -1,
//    'posts_per_page' => 100,
//    'paged' => enc_param('pg', $_GET, 1),
  );

  $the_query = new WP_Query($args);
  if ($the_query->have_posts()):
  while ($the_query->have_posts()): $the_query->the_post();
  
    if (get_field('review_tmdb_id') != '') {     
      info_tmdb(get_field('review_tmdb_id'), get_the_id());
    }

  endwhile;
  endif;
  wp_reset_query();
  */
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      body {
        font-family: sans-serif;
        font-size: 16px;
        line-height: 1.5;
      }
    </style>
    <script>
      location.href = "/wp-admin/post.php?post=<?php echo $post_id; ?>&action=edit";
    </script>
  </head>
  <body>
  </body>
</html>