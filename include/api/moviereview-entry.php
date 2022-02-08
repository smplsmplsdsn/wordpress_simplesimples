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
  <?php include_once($theme_dir."/include/post/parts-head.php"); ?>
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