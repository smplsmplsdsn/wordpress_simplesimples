<?php
// WordPressのテンプレートパス
$theme_dir = get_template_directory();

// お手製のPHPファイルを読み込む
include_once($theme_dir."/functions/index.php");

// ログインしているか判別する
if (!is_user_logged_in()) {
  die();
}

// 管理者権限か判別する
if (!current_user_can('manage_options')) {
  echo 'login';
  die();
}

$post_id = enc_param('pid', $_GET);

$is_hide_robots = true;
$is_hide_head = true;
$view_type = 'moviereview';
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>映画レビュー登録画面</title>
    <?php include_once($theme_dir."/include/google.php"); ?>
    <meta name="robots" content="NONE">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-moviereview/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-moviereview/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/moviereview.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/moviereview.min.css"); ?>">
  </head>
  <body class="entry">
    <?php if ($post_id != ''): ?>
    <style>
      .js-entry-edit-view {
        display: block;
      }
    </style>
    <?php endif; ?>
    
    <div class="entry__inner">
      
      <div class="js-entry-edit-view">
        <p class="entry__link">
          <a class="entry__btn js-entry-edit-link" target="_blank">管理画面で編集する</a>
        </p>
      </div>
      
      <form class="entry__section">        
        <div>
          <input type="text" name="movie_title" value="" placeholder="映画タイトル">
        </div>
        <?php if ($post_id == ''): ?>
        <p class="entry__link">
          <a class="entry__btn js-entry-new">新規登録する</a>  
        </p>
        <p class="entry__error js-entry-error"></p>
        <?php endif; ?>
      </form>
      
      <div class="entry__edit js-entry-edit-view">
        <form class="entry__section">
          <table>
            <tr>
              <th>レビューID</th>
              <td><input type="text" name="post_id" value="<?php echo $post_id; ?>" readonly></td>
            </tr>
            <tr>
              <th><a class="entry__btn js-entry-link-youtube" target="_blank">YouTube予告</a></th>
              <td><input type="text" name="youtube" value="" placeholder="埋め込みタグ"></td>
            </tr>
            <tr>
              <th><a class="entry__btn js-entry-link-amazon" target="_blank">Amazon ID</a></th>
              <td><input type="text" name="amazon" value=""></td>
            </tr>
          </table>
          <p class="entry__link">
            <a class="entry__btn js-entry-update">更新する</a>  
          </p>
          <p class="entry__error js-entry-error-2"></p>
        </form>
        <form class="entry__section">
          <p class="entry__link">
            <a class="entry__btn js-entry-link-tmdb">TMDb</a> 
            <a class="entry__btn js-entry-link-google">Google</a> 
          </p>
          <div class="entry__flex">
            <span>TMDb情報</span>
            <label><input type="radio" name="type" value="movie" checked>MOVIE</label>
            <label><input type="radio" name="type" value="tv">TV</label>
            <input type="number" name="tmdb_id" value="" placeholder="TMDb ID" style="text-align: left;">
          </div>
          <p class="entry__link">
            <a class="entry__btn js-entry-tmdb">更新する</a>  
          </p>
          <p class="entry__error js-entry-error-3"></p>
        </form>
      </div>

      
    </div>
    
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>