<?php
/*
 * ディレクトリ名やGETパラメータからコンテンツタイプを決定する
 *
 * $post_type 投稿タイプ別にデザインを変える際や検索対象に使用する
 * $view_type CSSやJSのファイル名に使用する
 */
$post_type = get_dir(1);
$view_type = $post_type;

// TODO プレビューの場合の処理
if (isset($_GET['preview'])) {
  $post_type = 'web';
}

switch ($post_type) {
    
  // 投稿の場合
  case 'web':
  case 'video':
  case 'overview':
    $post_type = 'post';
    $view_type = 'post';
    break;
  
  case '':
    
    // 検索結果の場合
    if (isset($_GET["post_type"])) {
      $post_type = enc($_GET["post_type"]);
      $view_type = $post_type;
    } else {
      
      // トップ、エラーの場合
      $post_type = 'all';
      $view_type = 'simplesimples';
    }
    break;
        
  // defaultなし
}
