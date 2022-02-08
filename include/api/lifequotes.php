<?php
header("Content-Type: application/json; charset=utf-8");

// 除外するIDをGET['exclusion_id']指定する
$exclusion_id = (isset($_GET['exclusion_id']))? $_GET['exclusion_id']: '';

$data_array = [];

$args = array(
  'post_type' => 'lifequotes',
  'orderby' => 'rand',
  'posts_per_page' => 2,
);

$the_query = new WP_Query($args);
if ($the_query -> have_posts()):
while ($the_query -> have_posts()): $the_query -> the_post(); 

  $data_unit_array = [];

  $content = get_field("words_content");
  $content = preg_replace('/。$/', "", $content);

  $content = replace_br($content);

  $pg = get_the_id();

  $words_speaker = get_field("words_speaker");
  $words_background = get_field("words_background");
  $words_title = get_field("words_title");
  $words_author = get_field("words_author");
  $words_job = get_field("words_job");
  $words_year_born = get_field("words_year_born");
  $words_year_die = get_field("words_year_die");

  $words_wp_title = get_the_title();

  $words_info_array = array();
  if ($words_job != "" || $words_year_born > 0 || $words_title != "") {

    if ($words_job != "") {
      array_push($words_info_array, $words_job);            
    }

    if ($words_year_born > 0) {
      $words_year .= "";
      $words_year .= '<span class="nowrap">';
      $words_year .= $words_year_born." - ";
      if ($words_year_die > 0) {
        $words_year .= $words_year_die;
      }
      $words_year .= '</span>';
      array_push($words_info_array, $words_year);
    }

    if ($words_author != "" && $words_title != "") {
      array_push($words_info_array, $words_author.'「'.$words_title.'」より'); 
    } elseif ($words_author != "") {
      array_push($words_info_array, $words_author);                      
    } elseif ($words_title != "") {
      array_push($words_info_array, '「'.$words_title.'」より');                      
    }
  }

  if (count($words_info_array) > 0) {
    $words_info = implode($words_info_array, ', ');
  }

  $data_unit_array['id'] = $pg;
  $data_unit_array['content'] = $content;
  $data_unit_array['words_speaker'] = $words_speaker;
  $data_unit_array['words_info'] = $words_info;

  array_push($data_array, $data_unit_array);

endwhile;
endif;
wp_reset_query();    // 投稿データのリセット

if ($exclusion_id == $data_array[0]['id']) {
  unset($data_array[0]);
} else {
  unset($data_array[1]);
}

echo json_encode($data_array);
