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

// head ogp用画像
$head_ogp_img = mp_get_thumbnail();

// head タイトル
$head_title = wp_strip_all_tags(get_the_title())." - シンプルシンプルデザイン";

// head 概要文
$head_description = get_the_excerpt();
$is_post_desciption_more = (mb_strlen($head_description, 'UTF-8') > 100);
$head_description = mb_substr($head_description, 0, 100, 'UTF-8');
if ($is_post_desciption_more) {
  $head_description = $head_description."...";
}
$head_description = replace_rn_to_space($head_description);
$head_description = esc_html($head_description);

$view_type = 'simplesimples';

// includeチェック
$include_file_type = '';
switch (true) {
  case is_page('service'):
    $include_file_type = 'service';
    break;
  case is_page('video'):
    $include_file_type = 'service-video';
    break;
  case is_page('works'):
    $include_file_type = 'works';
    break;
  case is_page('about'):
    $include_file_type = 'about';
    break;
  case is_page('contact'):
    $include_file_type = 'contact';
    break;
  case is_page('socialmedia'):
    $include_file_type = 'socialmedia';
    break;
  case is_page('privacy'):
    $include_file_type = 'privacy';
    break;
  case is_page('terms'):
    $include_file_type = 'terms';
    break;
  case is_page('specifiedcommercialtransactions'):
    $include_file_type = 'specifiedcommercialtransactions';
    break;
    
  // default なし
}

?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <?php include_once($theme_dir."/include/head.php"); ?>
  <body data-page="<?php echo get_post_field('post_name', get_the_id()); ?>">
    
    <div class="inner">
      <div class="header">
        <a href="/"><img class="header__logo-image" src="<?php echo ASSETS_PATH; ?>/images/simplesimplesdesign-a2.svg" alt="シンプルシンプルデザイン"></a>
      </div>

      <div class="container">
        <h1 class="container__title"><?php the_title(); ?></h1>
        <div>
          <?php
          if ($include_file_type != '') {
            include_once($theme_dir."/include/page-".$include_file_type.".php");
          } else {
            the_content();
          }
          ?>
        </div>
      </div>
    </div>
    
    <?php include_once($theme_dir."/include/nav-menu.php"); ?>
    <?php include_once($theme_dir."/include/footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>