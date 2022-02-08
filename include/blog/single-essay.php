<?php
$sns_link_twitter = 'https://twitter.com/share?url='.rawurlencode(get_permalink()).'&text='.rawurlencode(get_the_title()."【Taketake's Blog】");
$sns_link_facebook = 'https://www.facebook.com/sharer/sharer.php?u='.rawurlencode(get_permalink());
$sns_link_line = 'https://line.me/R/msg/text/?'.rawurlencode("【Taketake's Blog】".get_the_title()." ".get_permalink());

if (have_posts()){
	while(have_posts()){    
		the_post();
		$post_id = get_the_id();
		$post_title = wp_strip_all_tags(get_the_title());
		$post_time = get_the_time('Y-m-d\TH:i');
		$post_date = get_the_time('Y年n月j日');
		$post_date_year = get_the_time('Y');
		$post_date_month = strtoupper(get_post_time('M'));
		$post_date_day = get_the_time('j'); 
    
    $age = get_age_at_that_time(get_the_time('Ymd'), '1975-07-09');        
    $post_age = (!$age['is_same'])? '<span class="essay__age">(当時'.$age['age'].'歳)</span>': '';

    // head タイトル
    $head_title = $post_title." - 想い(エッセイ) | Taketake's Blog | シンプルシンプルデザイン";
	}
}
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
        <div class="essay__headline-day"><?php echo $post_date_day; ?></div>
        <div class="essay__headline-month"><?php echo $post_date_month; ?></div>
        <div class="essay__headline-year"><?php echo $post_date_year; ?></div>
      </div>
      
      <main class="essay__main">
        <h1 class="essay__title"><?php the_title(); ?></h1>
        <p class="essay__date">
          <time class="essay__time" datetime="<?php echo $post_time?>"><?php echo $post_date; ?></time>
          <?php echo $post_age; ?>
        </p>
        <div class="essay__content">
          <?php echo preg_replace("/\\\\n/", "<br>", get_the_content()); ?>  
        </div>
        
        <div class="essay__sns">
          <p>メッセージ、DMでお待ちしてます</p>
          <a class="essay__sns-twitter" href="https://twitter.com/tabinoto" target="_blank">
            <span class="icon-twitter"></span>
          </a>
        </div>
      </main>
      
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