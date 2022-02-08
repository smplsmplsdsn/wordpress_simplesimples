<?php
/*

// アクセスするごとに24時間有効なクッキーを作る場合
setcookie('name', 'value', time() + 24*60*60);

// セッションがあれば、それを利用し、なければセッションを発行する場合
if (isset($_SESSION['name'])) {
  $session_key = $_SESSION['name'];
} else {
  $session_key = md5(md5(time()).'value');
  $_SESSION['name'] = $session_key;
}
*/
// WordPressのテンプレートパス
$theme_dir = get_template_directory();

// お手製のPHPファイルを読み込む
include_once($theme_dir."/functions/index.php");

$message = '';

/* エラーページ */
$uri = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$message .= "エラーページは、".$uri."\n";

/* 参照元によって振り分け処理 */
$referer = (isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER']: "直接です\n";
$message .= "参照元は、".$referer."\n";

$addr = (isset($_SERVER["REMOTE_ADDR"]))? $_SERVER["REMOTE_ADDR"]: "不明です\n";
$message .= 'ホストは、'.$addr;

/**
 * リダイレクトかエラーページか
 * 下記ディレクトリは今後作らない
 * blog|sp-london|thebeautifulbutemptyphotos|tokyo
 */
$public_path = $_SERVER["REQUEST_URI"];

$is_mail = true;

switch (true) {
  case (preg_match('/(.*)author=(.*)/i', $public_path)):
  case (preg_match('/(.*)account(.*)/i', $public_path)):
  case (preg_match('/(.*)api(.*)/i', $public_path)):
  case (preg_match('/(.*)aws(.*)/i', $public_path)):
  case (preg_match('/(.*)ccx(.*)/i', $public_path)):
  case (preg_match('/(.*)config(.*)/i', $public_path)):
  case (preg_match('/(.*)data(.*)/i', $public_path)):
  case (preg_match('/(.*)demo(.*)/i', $public_path)):
  case (preg_match('/(.*)docs(.*)/i', $public_path)):
  case (preg_match('/(.*)env(.*)/i', $public_path)):
  case (preg_match('/(.*)error(.*)/i', $public_path)):
  case (preg_match('/(.*)files(.*)/i', $public_path)):
  case (preg_match('/(.*)gallery(.*)/i', $public_path)):
  case (preg_match('/(.*)image(.*)/i', $public_path)):
  case (preg_match('/(.*)img(.*)/i', $public_path)):
  case (preg_match('/(.*)info(.*)/i', $public_path)):
  case (preg_match('/(.*)mt(.*)/i', $public_path)):
  case (preg_match('/(.*)p=(.*)/i', $public_path)):
  case (preg_match('/(.*)pdf(.*)/i', $public_path)):
  case (preg_match('/(.*)plugins(.*)/i', $public_path)):
  case (preg_match('/(.*)regist(.*)/i', $public_path)):
  case (preg_match('/(.*)server(.*)/i', $public_path)):
  case (preg_match('/(.*)signup(.*)/i', $public_path)):
  case (preg_match('/(.*)template(.*)/i', $public_path)):
  case (preg_match('/(.*)upload(.*)/i', $public_path)):
  case (preg_match('/(.*)yml(.*)/i', $public_path)):
  case (preg_match('/(.*)wp-content(.*)/i', $public_path)):
  case (preg_match('/(.*)\.[env|woff](.*)/i', $public_path)):
  case (preg_match('/(.*)\.[html|html|js|css|php|yml|xml|pdf](.*)/i', $public_path)):
  case (preg_match('/(.*)\.[jpg|jpeg|png|gif](.*)/i', $public_path)):
  case (preg_match('/(.*)\/smplsmpldsn\/(.*)/', $public_path)):
    $is_error = true;
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)\/amp\/$/', $uri)):
    $redirect_url = preg_replace('/(.*)\/amp\/$/', '$1', $uri);
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)\/amp$/', $uri)):
    $redirect_url = preg_replace('/(.*)\/amp$/', '$1', $uri);
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)\/null\/$/', $uri)):
    $redirect_url = preg_replace('/(.*)\/null\/$/', '$1', $uri);
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)\/null/', $uri)):
    $redirect_url = preg_replace('/(.*)\/null/', '$1', $uri);
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)\/camera-redirect\/$/', $public_path)):
  case (preg_match('/(.*)\/relationship\/$/', $public_path)):
    $redirect_url = "/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/web\/(.*)/', $public_path)):
    $redirect_url = "/web/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/blog\/(.*)/', $public_path)):
    $redirect_url = "/blog/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/moviereview\/(.*)/', $public_path)):
    $redirect_url = "/moviereview/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/lyric\/(.*)/', $public_path)):
    $redirect_url = "/lyric/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/essay\/(.*)/', $public_path)):
    $redirect_url = "/essay/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/photo\/(.*)/', $public_path)):
    $redirect_url = "/photo/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/overview\/memo\/aboutsonyalpha(.*)/', $public_path)):
    $redirect_url = "/overview/dairy/sonyalpha/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/overview\/dairy(.*)/', $public_path)):
    $redirect_url = "/overview/dairy/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/overview\/memo\/(.*)/', $public_path)):
    $redirect_url = "/overview/memo/";
    $is_mail = false;
    break;
  
  case (preg_match('/\/overview\/update(.*)/', $public_path)):
    $redirect_url = "/overview/update/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/thinking\/seminar(.*)/', $public_path)):
    $redirect_url = "/web/management/event/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/study(.*)/', $public_path)):
    $redirect_url = "/web/management/knowledge/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/marketing\/(.*)/', $public_path)):
    $redirect_url = "/web/works/marketing/";
    $is_mail = false;
    break;
    
  case (preg_match('/\/design(.*)/', $public_path)):
  case (preg_match('/\/thinking(.*)/', $public_path)):
    $redirect_url = "/web/";
    $is_mail = false;
    break;
    
  case (preg_match('/(.*)davinciresolve(.*)/', $public_path)):
    $redirect_url = "/video/davinciresolve/";
    $is_mail = false;
    break;

    
  case (preg_match('/(.*)otonanoaoharuten(.*)/', $public_path)):
    $redirect_url = "/?event=otonanoaoharuten";
    $is_mail = false;
    break;
    
  // defaultなし
    
}

if ($is_mail === true) {
  wp_mail("simplesimplesdesign@gmail.com", "【SimpleSimplesDesign】エラーがありました", $message, "simplesimplesdesign@gmail.com");
}

if (isset($is_error)) {
  echo ' ';
  die();
} elseif (isset($redirect_url)) {
  header('Location: '.$redirect_url);
  exit();
}
?>
<!doctype html>
<html lang="ja">
  <head>
    <?php include_once($theme_dir."/include/google.php"); ?>
    <meta charset="utf-8">
    <title>Not Found - シンプルシンプルデザイン</title>
    <meta name="robots" content="NONE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/manifest/manifest.json">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Ubuntu|M+PLUS+1p&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/error.css">
  </head>
	<body>
    
    <div class="text">
      <div>
        <h1>
          <span class="en">Not Found...</span><br>
          <span class="ja">ページが見つからない...</span>
        </h1>

        <p>
          <span class="en">I'm not sure why...</span><br>
          <span class="ja">なんでか分からないけど、</span>
        </p>
        <p>
          <span class="en">Okey, let's go home page!</span><br>
          <span class="ja">とりあえず、トップページに行こう！</span>
        </p>
        <p>
          <a class="ja-link" href="/">→ シンプルシンプルデザイン</a>
        </p>      
      </div>
    </div>
    
    <figure class="bg"></figure>
    
 
  </body>
</html>
