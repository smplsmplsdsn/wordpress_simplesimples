<?php

// head タイトル
$head_title = "想い(エッセイ) | Taketake's Blog | シンプルシンプルデザイン";
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
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700|Kosugi&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-<?php echo $view_type; ?>/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-".$view_type."/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
    <link rel="canonical" href="<?php echo get_permalink(); ?>">
  </head>
  <body>
    
    <div class="essay js-essay" data-id="<?php the_id(); ?>">
      
      <div class="essay__headline">
        <h1 class="essay__logo">
          <span class="essay__logo-ja">
            <img src="<?php echo ASSETS_PATH; ?>/images/blog/essay.svg" alt="想">
          </span>
          <span class="essay__logo-en">Essay</span>
        </h1>
      </div>
      
      <ul class="essay__list js-essay-list">
        <?php
        $args = array(
          'post_type' => 'essay',
          'posts_per_page' => -1,
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
        while ($the_query->have_posts()): $the_query->the_post();
          $post_time = get_the_time('Y-m-d\TH:i');
          $post_date = get_the_time('Y年n月j日');
        ?>
        <li data-id="<?php the_id(); ?>">
          <a href="<?php echo get_permalink(); ?>">
            <span><?php the_title(); ?></span>
            <time datatime="<?php echo $post_time; ?>"><?php echo $post_date; ?></time>
          </a>
        </li>
        <?php
        endwhile;
        endif;
        wp_reset_query();    // 投稿データのリセット        
        ?>
      </ul>
    </div>
    
    <?php include_once($theme_dir."/include/blog/blog-nav.php"); ?>
    <?php include_once($theme_dir."/include/blog/blog-footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>