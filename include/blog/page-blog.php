<?php

// head タイトル
$head_title =  "Taketake's Blog - シンプルシンプルデザイン";
$head_manifest = 'manifest-blog';
$view_type = 'blog';
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
  <body class="blog">
    
    <h1 class="blog__title"><span class="icon-b"></span></h1>
    
    <div class="slideshow blog__slide">
      <div class="slideshow__frame">
        <div class="slideshow__flex">
          <?php
          $p_num = 0;
          $args = array(
            'post_type' => array('moviereview', 'photo', 'lyric', 'essay'),
            'posts_per_page' => 10,
          );

          $the_query = new WP_Query($args);
          if ($the_query -> have_posts()):
          while ($the_query -> have_posts()): $the_query -> the_post();
          
            $p_num++;
          
            switch (get_post_type_object(get_post_type()) -> name) {
              case 'moviereview':
                $img_path = 'https://image.tmdb.org/t/p/w342'.get_field('review_tmdb_poster');
                ?>
          <a class="slideshow__unit blog__slide-unit blog__slide-unit--moviereview js-link-slideshow" data-href="<?php echo get_the_permalink(); ?>" style="background-image: url(<?php echo $img_path; ?>);">
            <div class="blog__slide-content">
              <p class="blog__slide-category"><span>映画レビュー</span></p>
              <p class="blog__slide-title"><span><?php the_title(); ?></span></p>
            </div>
          </a>
                <?php
                break;
              case 'photo':
                $img_path = '';
                if (get_the_post_thumbnail_url()) {
                  $img_path = get_the_post_thumbnail_url($post_id, 'large');
                }
                ?>
          <a class="slideshow__unit blog__slide-unit blog__slide-unit--photo js-link-slideshow" data-href="<?php echo get_the_permalink(); ?>" style="background-image: url(<?php echo $img_path; ?>);">
            <div class="blog__slide-content">
              <p class="blog__slide-category"><span>PHOTO</span></p>
              <p class="blog__slide-title"><span><?php the_title(); ?></span></p>
            </div>
          </a>
                <?php
                break;
              case 'lyric':
                ?>
          <a class="slideshow__unit blog__slide-unit blog__slide-unit--lyric js-link-slideshow" data-href="<?php echo get_the_permalink(); ?>" style="background-image: url(<?php echo ASSETS_PATH; ?>/images/blog/lyric-bg.jpg);">
            <div class="blog__slide-content">
              <p class="blog__slide-category"><span>詩(うた)</span></p>
              <p class="blog__slide-title"><span><?php the_title(); ?></span></p>
            </div>
          </a>
                <?php
                break;
              case 'essay':
                $content = wp_strip_all_tags(get_the_content());
                ?>
          <a class="slideshow__unit blog__slide-unit blog__slide-unit--essay js-link-slideshow" data-href="<?php echo get_the_permalink(); ?>">
            <div class="blog__slide-essay js-slide-essay"><?php echo $content; ?></div>
            <div class="blog__slide-content">
              <p class="blog__slide-category"><span>ESSAY 想い</span></p>
              <p class="blog__slide-title"><span><?php the_title(); ?></span></p>
            </div>
          </a>
                <?php
                break;
                
              // defaultなし
            }
          ?>
          <?php
          endwhile;
          endif;
          wp_reset_query();    // 投稿データのリセット      
          ?>      
        </div>
      </div>
      <div class="js-slide-nav blog__slide-nav">
        <?php
        for ($i = 1; $i <= $p_num; $i++) {
          echo '<a data-nav="'.$i.'">●</a>';
        }
        ?>
      </div>      
    </div>
    
    <section class="blog__lifequotes">
      <div class="blog__lifequotes-inner">
        <h1 class="blog__lifequotes-title">言ノ葉</h1>
        <div class="js-lifequotes">
          <span class="animation-blinker">loading...</span>
        </div>
      </div>
    </section>
    
    <section class="blog__twitter">
      <div class="js-twitter">
        <div class="blog__twitter-loading"><span class="animation-blinker">loading...</span></div>
      </div>
      <h1 class="blog__twitter-title"><span class="icon-twitter"></span> Taketake's Twitter</h1>
      <nav class="blog__twitter-nav">
        <dl>
          <div>
            <dt><a class="smplsmplsdsn" href="https://twitter.com/smplsmplsdsn" target="_blank">@smplsmplsdsn</a></dt>
            <dd>WEB制作や映像・写真のこと</dd>
          </div>
          <div>
            <dt><a class="filmpathy" href="https://twitter.com/filmpathy" target="_blank">@filmpathy</a></dt>
            <dd>観たい映画や観た映画のこと</dd>
          </div>
          <div>
            <dt><a class="fiveminutediary" href="https://twitter.com/FiveMinuteDiary" target="_blank">@FiveMinuteDiary</a></dt>
            <dd>英会話で学んだこと</dd>
          </div>
          <div>
            <dt><a class="tabinoto" href="https://twitter.com/tabinoto" target="_blank">@tabinoto</a></dt>
            <dd>エッセイには短い本音やぼやき</dd>
          </div>
        </dl>
      </nav>
    </section>
    
    <nav class="blog__nav">
      <ul>
        <li>
          <a href="/moviereview/">
            <figure class="blog__nav-moviereview"></figure>
            <span><span class="icon-film"></span>映画レビュー</span>
          </a>
        </li>
        <li>
          <a href="/photo/">
            <figure class="blog__nav-photo"></figure>
            <span><span class="icon-camera"></span>写真</span>
          </a>
        </li>
        <li>
          <a href="/essay/">
            <figure class="blog__nav-essay"></figure>
            <span><span class="icon-book-open"></span>エッセイ「想い」</span>
          </a>
        </li>
        <li>
          <a href="/lyric/">
            <figure class="blog__nav-lyric"></figure>
            <span><span class="icon-music"></span>詩(うた)</span>
          </a>
        </li>
      </ul>
    </nav>
    
    <nav class="nav js-nav">
      <div class="nav__menu">
        <a class="js-pagetop"><span class="icon-b"></span></a>
      </div>
      <div class="nav__list">
        <a href="/moviereview/" class="nav__list-moviereview"><span class="icon-film"></span></a>        
        <a href="/photo/" class="nav__list-photo"><span class="icon-camera"></span></a>        
        <a href="/essay/"><span class="icon-book-open"></span></a>        
        <a href="/lyric/"><span class="icon-music"></span></a>        
      </div>
    </nav>    
    
    <?php include_once($theme_dir."/include/blog/blog-footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
    <script>
      $(function () {
        lifequotes();
        twitter();
        slide.show('.slideshow');        

        $('.js-pagetop').on('click', function () {
          pageScroll();
          return false;
        });        
      });
    </script>
  </body>
</html>
    