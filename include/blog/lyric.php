<?php
$head_manifest = 'manifest-blog';
$view_type = 'blog';

if (is_single()) {
  $head_title = get_the_title()." - 詩(うた) | Taketake's Blog | シンプルシンプルデザイン";
  $canonical = get_permalink();
  $body_class = "single";
} else {
  $head_title = "詩(うた) | Taketake's Blog | シンプルシンプルデザイン";
  $canonical = 'https://simplesimples.com/lyric/';
  $body_class = "archive";
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
    <link rel="canonical" href="<?php echo $canonical; ?>">
  </head>
  <body class="lyric <?php echo $body_class; ?>">
    <?php
    if (is_single()):
    if (have_posts()){
      while(have_posts()){    
        the_post();
        
        $content = get_the_content();
        // $content = preg_replace('/\n/', '<br>', $content);

        if ($terms = get_the_terms($id, 'lyric_performance')) {
          foreach ($terms as $term){
            $term_slug = $term->slug;
            $term_name = $term->name;
          }    
        } else {
          $term_slug = "";
          $term_name = "";
        }

        $time = get_the_date('Y-m-d\TH:i');
        $date = get_the_date('Y/n/j');
        $age_info = get_age_at_that_time(get_the_date('Y-m-d'), '1975-07-09');
        
        if (!$age_info['is_same']) {
          $html_age = '<span class="lyric__age">(当時'.$age_info['age'].'歳)</span>';
        } else {
          $html_age = '';
        }
    ?>
    <main class="lyric__main">
      <h1 class="lyric__title"><?php the_title(); ?></h1>
      <?php if ($term_name != 'たけたけ' && $term_name != ''): ?>
      <p class="lyric__performance">performance: <?php echo $term_name; ?></p>
      <?php endif; ?>
      <p class="lyric__author">lyric: たけたけ<?php echo $html_age; ?></p>
      <time class="lyric__date" datetime="<?php echo $time?>"><?php echo $date; ?></time>
      <div class="lyric__content">
        <?php echo $content; ?>
      </div>
    </main>
    <?php
      }
    }
    endif;
    ?>
    <img class="lyric__cover" src="<?php echo ASSETS_PATH; ?>/images/blog/lyric-bg.jpg">
    <nav class="lyric__nav">
          <?php
          /*
          $terms = get_terms('lyric_performance');
          foreach ($terms as $term){
          ?>
          <li>
            <a class="js-link-performance" data-performance="<?php echo $term -> slug; ?>">
              <figure class="lyric__nav-figure lyric__nav-figure--<?php echo $term -> slug; ?>"></figure>
              <span><?php echo $term -> name; ?></span>
            </a>
          </li>
          <?php
          }
          */
          ?>
      <div class="lyric__nav-songs">
        <ul class="lyric__nav-list">
          <?php
          // 検索クエリを用意する
          $args = array(
            'post_type' => 'lyric',
            'posts_per_page' => -1,
          );

          // データを取得する
          $the_query = new WP_Query($args);
          if ($the_query -> have_posts()):
          while ($the_query -> have_posts()): $the_query -> the_post();

            if ($terms = get_the_terms($id, 'lyric_performance')) {
              foreach ($terms as $term){
                $term_slug = $term -> slug;
                $term_name = $term -> name;
              }    
            } else {
              $term_slug = "";
              $term_name = "";
            }
          ?>
          <li data-performance="<?php echo $term_slug; ?>">
            <a href="<?php the_permalink(); ?>">
              <strong><?php the_title(); ?></strong>
              <span><?php echo $term_name; ?></span>
            </a>
          </li>          
          <?php
          endwhile;
          endif;

          // 投稿データのリセット
          wp_reset_query();          
          ?>          
        </ul>
      </div>
    </nav>

    <section class="lyric__credit">
      <h1 class="lyric__credit-title">メロディのある詩（うた）</h1>
      <div class="lyric__credit-outline">
        <p>中学時代から詩を書くのが好きで。当初は現実離れした妄想の内容だったけど、大学時代からは自分の気持ちを含めて等身大でつづれるようになりました。ここでは、詩のみだと結構な量になってしまうので、大学時代以降のメロディのある曲に書いた詩（うた）に限定して紹介します。「想い」を詩(うた)にして、バンド活動、ソロの弾き語り、自主制作映画の主題歌・・・さまざまなカタチで表現しています。</p>
      </div>
      
      <div class="lyric__credit-list">
        <section class="lyric__credit-unit">
          <h1 class="lyric__credit-name">
            <figure class="lyric__credit-fig lyric__credit-fig--daysweet"></figure>
            <span>daysweet</span>
          </h1>
          <p class="lyric__credit-term">
            <span>活動期間</span>2003.8 - 2005.5            
          </p>
          <table class="lyric__credit-member">
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>たけたけ</td>
            </tr>
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>もっしー <span class="nowrap">→ まっちー</span></td>
            </tr>
            <tr>
              <th>Drums</th>
              <td>北村先生</td>
            </tr>
            <tr>
              <th>Bass</th>
              <td>ごま</td>
            </tr>
          </table>
        </section>
        <section class="lyric__credit-unit">
          <h1 class="lyric__credit-name">
            <figure class="lyric__credit-fig lyric__credit-fig--allinthemind"></figure>
            <span>all in the mind</span>
          </h1>
          <p class="lyric__credit-term">
            <span>活動期間</span>2002.4 - 2003.4            
          </p>
          <table class="lyric__credit-member">
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>たけたけ</td>
            </tr>
            <tr>
              <th>Drums&amp;Chorus</th>
              <td>ことり</td>
            </tr>
            <tr>
              <th>Bass</th>
              <td>かりん</td>
            </tr>
          </table>
        </section>
        <section class="lyric__credit-unit">
          <h1 class="lyric__credit-name">
            <figure class="lyric__credit-fig lyric__credit-fig--plum"></figure>
            <span>plum</span>
          </h1>
          <p class="lyric__credit-term">
            <span>活動期間</span>2001.4 - 2002.3
          </p>
          <table class="lyric__credit-member">
            <tr>
              <th>Drums&amp;Chorus</th>
              <td>ことり</td>
            </tr>
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>もてくん</td>
            </tr>
            <tr>
              <th>Bass&amp;Chorus</th>
              <td>たけたけ</td>
            </tr>
          </table>
        </section>
        <section class="lyric__credit-unit">
          <h1 class="lyric__credit-name">
            <figure class="lyric__credit-fig lyric__credit-fig--pastelsbadges"></figure>
            <span>Pastels badges</span>
          </h1>
          <p class="lyric__credit-term">
            <span>活動期間</span>1999前後
          </p>
          <table class="lyric__credit-member">
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>もてくん</td>
            </tr>
            <tr>
              <th>Bass&amp;Chorus</th>
              <td>ひめ</td>
            </tr>
            <tr>
              <th>Drums</th>
              <td>みほちゃん</td>
            </tr>
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>たけたけ</td>
            </tr>
          </table>
        </section>
        <section class="lyric__credit-unit">
          <h1 class="lyric__credit-name">
            <figure class="lyric__credit-fig lyric__credit-fig--bremen"></figure>
            <span>bremen</span>
          </h1>
          <p class="lyric__credit-term">
            <span>活動期間</span>1997.11 - 2001.1
          </p>
          <table class="lyric__credit-member">
            <tr>
              <th>Guitar&amp;Vocal</th>
              <td>たけたけ</td>
            </tr>
            <tr>
              <th>Drums</th>
              <td>けん</td>
            </tr>
            <tr>
              <th>Bass</th>
              <td>まっちゃん</td>
            </tr>
          </table>
        </section>
      </div>
    </section>
    

    
    <?php include_once($theme_dir."/include/blog/blog-nav.php"); ?>
    <?php include_once($theme_dir."/include/blog/blog-footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>