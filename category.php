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

$post_category = get_queried_object();
$post_category_name = $post_category -> name;
$post_category_base = $post_category -> slug;  

// head
$head_ogp_img = mp_get_thumbnail('0', $post_category_base);
$head_title = $post_category_name."に関する記事 - シンプルシンプルデザイン";
$head_description = wp_strip_all_tags(category_description(), true);
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
            <h1 class="list__title"><?php echo $post_category_name; ?></h1>
            <p><?php echo $post_category_name; ?>に関する記事は、<?php echo $wp_query->found_posts; ?>件あります。</p>
            <p><?php echo category_description(); ?></p>
          </div>

          <div class="grid grid--list">
            <?php if (have_posts()): while(have_posts()): the_post(); ?>
            <?php echo mp_html_list_unit(get_the_id()); ?>
            <?php endwhile; endif; ?>
          </div>
        </div>        
      </div>
      
      <?php include_once($theme_dir."/include/post/parts-tabbar.php"); ?>
      <?php include_once($theme_dir."/include/post/parts-footer.php"); ?>
    </div>
    
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>