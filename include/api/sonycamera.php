<?php
header("Content-Type: application/json; charset=utf-8");

// 設定
// 前提ルール: 項目名はデータより上の行に記載されていること
$file_name = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTEc1RvYOjS4lcIc6eDeSXXqvGP8KZGzd5O0rZ7JKXnYESzJ335DuYZKMcZPrxp8o_g277zgAlxptUs/pub?gid=377547214&single=true&output=csv";
$file_path = __DIR__.'/sonycamera-auto.php';

$validity_period = 60*60*6;   // 有効期間: 秒単位（1日： 60*60*24）
$line_label_row = 1;    // ラベルとして利用する行数（0始まり）
$line_data_row = 2;    // データとして利用する開始行数（0始まり）

// リファラー確認
// TODO 外部アクセスの場合はエラーを表示する
// TODO ダイレクトアクセスの場合は条件を使って表示可能にする Getパラメータが妥当かな

// ファイル情報
$is_file_ready = false;
$line_no = 0;


// ローカルにコピーファイルがあるか、かつゲットパラメータ「update」がないか確認する
if (file_exists($file_path) && !(isset($_GET["update"]))) {

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

// Googleスプレッドシートから最新情報を取得するか判別する
if (!$is_file_ready) {
      
  // 配列
  $data_array = [];
  $data_label_array = [];
  
  // ラベルを作成する
  function create_label_array($line) {
    $return_array = [];
    for ($i = 0; $i < count($line); $i++) {
      $return_array[$i] = $line[$i];
    }
    return $return_array;
  }
  
  // データを連想配列にする
  function change_array($line, $array) {
    $return_array = [];    
    for ($i = 0; $i < count($line); $i++) {
      $return_array[$array[$i]] = $line[$i];
    }
    return $return_array;
  }
  
  $f = fopen($file_name, "r");    // ファイルを読み込む

  // 1行ずつ読み込む
  while($line = fgetcsv($f)) {
    if ($line_no === $line_label_row) {
      $data_label_array = create_label_array($line);
    } elseif ($line_no >= $line_data_row) {
      array_push($data_array, change_array($line, $data_label_array));
    }
    $line_no = $line_no + 1;
  }
    
  fclose($f);   // ファイルを閉じる

  echo json_encode($data_array);

  file_put_contents($file_path, json_encode($data_array));    // ファイルをコピーする
}

