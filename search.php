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

// 検索結果
$s_result_num = $wp_query -> found_posts;
$is_result = $s != "" && $s_result_num > 0;

// head
$head_ogp_img = mp_get_thumbnail();
$head_title = "「".$s."」にヒットした記事一覧 - シンプルシンプルデザイン";
$head_description = "「".$s."」にヒットしたすべての記事をリストアップします。";
?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <?php include_once($theme_dir."/include/post/parts-head.php"); ?>
  <body>
    
    <div class="wrapper">
      <div class="wrapper__inner wrapper__inner--list js-wrapper-inner">
        <div class="header">
          <?php include_once($theme_dir."/include/topicpath.php"); ?>
        </div>
        
        <div class="list">
          <?php include($theme_dir."/include/post/parts-search-form.php"); ?>
          
          <div class="list__header">
            <h1 class="list__title">「<?php echo $s; ?>」にヒットした記事一覧</h1>
						<?php if ($is_result): ?>
						<p>「<?php echo $s; ?>」にヒットした記事は全部で<?php echo $s_result_num; ?>件見つかりました。</p>
						<?php else: ?>
						<p>「<?php echo $s; ?>」にヒットする記事は見つかりませんでした。</p>
						<?php endif; ?>
          </div>
          
          <?php if ($is_result): ?>
          <div class="grid grid--list">
            <?php if (have_posts()): while(have_posts()): the_post(); ?>
            <?php echo mp_html_list_unit(get_the_id()); ?>
            <?php endwhile; endif; ?>
          </div>
          <?php endif; ?>
          
        </div>        
      </div>
      
      <?php include_once($theme_dir."/include/post/parts-tabbar.php"); ?>
      <?php include_once($theme_dir."/include/post/parts-footer.php"); ?>
    </div>
    
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>