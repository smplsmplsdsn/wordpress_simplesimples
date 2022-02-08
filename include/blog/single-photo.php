<?php
$sns_link_twitter = 'https://twitter.com/share?url='.rawurlencode(get_permalink()).'&text='.rawurlencode(get_the_title()."【Taketake's Blog】");
$sns_link_facebook = 'https://www.facebook.com/sharer/sharer.php?u='.rawurlencode(get_permalink());
$sns_link_line = 'https://line.me/R/msg/text/?'.rawurlencode("【Taketake's Blog】".get_the_title()." ".get_permalink());

if (have_posts()){
	while(have_posts()){    
		the_post();
		$post_id = get_the_id();
    $post_content = get_the_content();

		// キャッチ画像取得
		$post_img = '';
		if (get_the_post_thumbnail_url()) {
			$post_img = get_the_post_thumbnail_url($post_id, 'large');
    }
    
    // head ogp用画像
    $head_ogp_img = ($post_img != '')? $post_img: mp_get_thumbnail($post_id, '', $post_content);

    // PHOTO カスタムフィールド
    $photo_date = get_field("photo_date");
    if ($photo_date == '') {
      $photo_date = get_the_time('Y/n/j');
    }
    
    $photo_first_no = get_field("photo_num");
	}
}

// 記事内のimgタグを抽出する
$html_imgs = "";
if (preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches) !== false) {
  foreach ($matches[1] as $img_path) {
    $html_imgs .= '<figure class="slideshow__unit" style="background-image: url('.$img_path.');"></figure>';
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
    <meta property="og:image" content="<?php echo $head_ogp_img; ?>">
    <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:500|Noto+Serif+JP:600|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-<?php echo $view_type; ?>/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-".$view_type."/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
    <link rel="canonical" href="<?php echo get_permalink(); ?>">
  </head>
  <body class="photo">
    
    <header class="photo__header js-header">
      <h1 class="photo__header-title"><a href="/photo/">PHOTO</a></h1>
    </header>
    
    <div class="photo__mainvisual js-photo-mainvisual" style="background-image:url(<?php echo $post_img; ?>);"><a class="js-slide-link" data-nav="<?php echo $photo_first_no; ?>"></a></div>
    
    
    <div class="photo__content">
      <h1 class="photo__title"><span><?php the_title(); ?></span></h1>
      <p>撮影日: <?php echo $photo_date; ?></p>
      
      <div class="js-content">
        <?php the_content(); ?>
      </div>
      
      <div class="essay__sns">
        <p>メッセージ、DMでお待ちしてます</p>
        <a class="essay__sns-twitter" href="https://twitter.com/tabinoto" target="_blank">
          <span class="icon-twitter"></span>
        </a>
      </div>
    </div>
    
    <div class="slideshow photo__slideshow js-photo-slide">
      <div class="slideshow__frame">
        <div class="slideshow__flex">
          <?php echo $html_imgs; ?>        
        </div>
      </div>
    </div>
    
    <div class="photo__splash js-photo-splash">
      <div class="photo__splash-inner">
        <p class="photo__splash-title">PHOTO</p>
        <p class="photo__splash-loading-bar">
          <span class="photo__splash-bar js-photo-bar"></span>
        </p>
      </div>
    </div>
    
    <?php include_once($theme_dir."/include/blog/blog-nav.php"); ?>
    <?php include_once($theme_dir."/include/blog/blog-footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
    <script>
      photoPreLoad();
    </script>
  </body>
</html>