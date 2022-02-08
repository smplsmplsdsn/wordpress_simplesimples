<?php

// head タイトル
$head_title = "PHOTO | Taketake's Blog | シンプルシンプルデザイン";
?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <title><?php echo $head_title; ?></title>
    <?php include_once($theme_dir."/include/google.php"); ?>
    <meta name="robots" content="ALL">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:500|Noto+Serif+JP:600|Roboto&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-<?php echo $view_type; ?>/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-".$view_type."/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
    <link rel="canonical" href="<?php echo get_permalink(); ?>">
  </head>
  <body class="photo">
    <header class="photo__header">
      <h1 class="photo__header-title"><a href="/photo/">PHOTO</a></h1>
    </header>
    
    <ul class="photo__list">
      <?php
      $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()):
      while ($the_query->have_posts()): $the_query->the_post();
      
        // キャッチ画像取得
        $post_img = '';
        if (get_the_post_thumbnail_url()) {
          $post_img = get_the_post_thumbnail_url($post_id, 'medium');
        }

        // PHOTO カスタムフィールド
        $photo_date = get_field("photo_date");
        if ($photo_date == '') {
          $photo_date = get_the_time('Y/n/j');
        }      
      ?>
      <li>
        <a href="<?php echo get_permalink(); ?>">
          <figure style="background-image: url(<?php echo $post_img; ?>);"></figure>
          <span><?php the_title(); ?></span>
          <time>撮影日: <?php echo $photo_date; ?></time>
        </a>
      </li>
      <?php
      endwhile;
      endif;
      wp_reset_query();    // 投稿データのリセット        
      ?>
    </ul>
      
    <?php include_once($theme_dir."/include/blog/blog-nav.php"); ?>
    <?php include_once($theme_dir."/include/blog/blog-footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>