<?php
/**
 * 指定日が当時何歳だったかを取得する
 * ATTENSION YYYY-MM-DD、もしくはYYYYMMDDの形式で指定
 * e.g., 1975-07-09 もしくは 19750709
 *
 * @param (string) $d* 指定日 YYYY-MM-DD
 * @param (string) $b* 誕生日 YYYY-MM-DD
 * @return (array) 指定日の年齢と現在と年齢比較
 */
function get_age_at_that_time($d = '', $b = '') {  
  $day = preg_replace('/-/', '', $d);
  $b_day = preg_replace('/-/', '', $b);
  $now_string = date('Ymd');
  $age_obj = [];
          
  if ($day - $b_day > 0) {
    $age_obj['age'] = floor(($day - $b_day)/10000);
    $age_obj['is_same'] = floor(($now_string - $b_day)/10000) === $age_obj['age'];
  }
  
  return $age_obj;
}