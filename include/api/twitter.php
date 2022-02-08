<?php
header("Content-Type: application/json; charset=utf-8");

// WordPressのテンプレートパス
$theme_dir = get_template_directory();

// お手製のPHPファイルを読み込む
include_once($theme_dir."/functions/index.php");

// 設定ファイルを読み込む
include_once('_config.php');

$file_path = __DIR__.'/twitter-auto.php';
$validity_period = 60*60*1;   // 有効期間: 秒単位（1日： 60*60*24）

// リファラー確認
// TODO 外部アクセスの場合はエラーを表示する
// TODO ダイレクトアクセスの場合は条件を使って表示可能にする Getパラメータが妥当かな

// ファイル情報
$is_file_ready = false;

$is_test = false;

// ローカルにコピーファイルがあるか、かつゲットパラメータ「update」がないか確認する
if (file_exists($file_path) && !(isset($_GET["update"])) && $is_test === false) {

  // ファイルの日付を取得する
  $file_time = filemtime($file_path);
  
  // ファイルの更新日が有効期間内か確認する
  if ((time() - $file_time) < $validity_period) {
    
    // ローカルのデータを取得する
    if ($json = file_get_contents($file_path)) {
      $is_file_ready = true;
      echo "$json";
    }
  }
}

if (!$is_file_ready) {
  
  // 配列
  $data_array = [];
  
  
  /**
   * Twitter API から情報を取得する
   * https://syncer.jp/Web/API/Twitter/REST_API/#section-3
   *
   * @param (string) $screen_name*: twitterのスクリーン名
   * @param (integer) $count: 取得するツイート数（リプやコメ含む）
   * @return (array) 連想配列
   */
  function getTwitter($screen_name, $count = 10) {
    $bearer_token = twitter_bearer_token;
    $request_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

    // パラメータ
    $params = array(
      'screen_name' => '@'.$screen_name,
      'count' => $count,
    ) ;

    // パラメータがある場合
    if ($params) {
      $request_url .= '?' .http_build_query($params);
    }

    // リクエスト用のコンテキスト
    $context = array(
      'http' => array(
        'method' => 'GET',
        'header' => array(
          'Authorization: Bearer '.$bearer_token,
        ),
      ),
    );

    // cURLを使ってリクエスト
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $request_url);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $context['http']['method']);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $context['http']['header']);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    $res1 = curl_exec($curl);
    $res2 = curl_getinfo($curl);
    curl_close($curl);
    $json = substr($res1, $res2['header_size']);  // 取得したデータ

    return json_decode($json, true);
  }
  
  // Tweetを取得してマージする
  $array_twitter = [];
  $array_twitter = array_merge($array_twitter, getTwitter('tabinoto'));
  $array_twitter = array_merge($array_twitter, getTwitter('smplsmplsdsn'));
  $array_twitter = array_merge($array_twitter, getTwitter('filmpathy'));
  $array_twitter = array_merge($array_twitter, getTwitter('FiveMinuteDiary'));  
  
  // 更新日順に並び替える
  $array_twitter = sort_by_key('id', $array_twitter);

  // 取得データを加工する
  $i = 0;
  foreach ($array_twitter as $key => $value) {
    $temp_array = [];
    
    if ($i < 15) {
      
      if ($value["in_reply_to_status_id"]) {    // リプとコメは削除する
        unset($array_twitter[$key]);
      } elseif (preg_match('/RT @/', $value['text'])) {   // RTは削除する
        unset($array_twitter[$key]);
      } else {
        date_default_timezone_set('UTC');
        $t = new DateTime($value['created_at']);
        $t->setTimeZone( new DateTimeZone('Asia/Tokyo'));
        $temp_array['created_at'] = $t->format('Y-m-d H:i');
        $temp_array['user'] = $array_twitter[$key]['user']['screen_name'];
        $temp_array['text'] = $array_twitter[$key]['text'];
        array_push($data_array, $temp_array);
        $i++;
      }      
    } else {
      break;
    }
  }

  echo json_encode($data_array);
  file_put_contents($file_path, json_encode($data_array));    // ファイルをコピーする  
}