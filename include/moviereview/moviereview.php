<?php
/**
 * アーカイブテンプレート
 * NOTICE シングルページはアーカイブにリダイレクトする
 */
$head_title = 'たけたけの映画レビュー';
$head_ogp_img = ASSETS_PATH.'/ogp-moviereview.jpg';
$head_description = '映画館やNetFlixやプライムビデオなどの配信映画で観た作品のレビュー。ここ最近は、つまらなかった場合は10段階評価だけにして、レビューテキストは良かった部分を書くように心がけています。';

$is_hide_head = true;

// レビュー数を取得する
$count_posts = wp_count_posts('moviereview');
$posts_count = $count_posts -> publish;
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
    <meta name="description" content="<?php echo $head_description; ?>">
    <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-moviereview/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-moviereview/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/moviereview.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/moviereview.min.css"); ?>">
    <link rel="canonical" href="<?php echo DOMAIN; ?>/moviereview/">
  </head>
  <body>
    
    <?php if (current_user_can('manage_options')): ?>
    <p class="login">
      <a href="/api/?class=moviereview-entry">新しいレビューを書く</a>
    </p>
    <?php endif; ?>
    
    <div class="detail js-detail">
      <div class="detail__inner js-detail-inner post"></div>
      <div class="detail__close">
        <a class="detail__close-link js-detail-close">
          <span class="icon-close"></span>
        </a>
      </div>
    </div>
    
    <header class="header">
      <h1 class="title">
        <span>
          <span class="title__main">Movie Reviews</span>
          <span class="title__sub">by Taketake</span>
        </span>
        <span class="title__num"><?php echo $posts_count; ?></span>
      </h1>
    </header>
    
    <p class="condition js-condition"></p>
            
    <div class="js-list list">
    </div>
    
    <div class="js-load-list list list--temp">
      <?php
      $content = @file_get_contents(DOMAIN.'/api/?class=moviereview-review-list');
      if ($content) {
        echo $content;
      }
      ?>
    </div>
    
    <div class="search js-search">
      <div class="search__inner">
        <div class="search__content">
          <div class="search__space js-search-close"></div>
          <div class="search__main">
            <form class="search__form js-form-freeword-search">
              <input type="hidden" name="class" value="moviereview-review-list">
              <div class="search__flex">
                <a class="js-search-clear" data-type="freeword">クリア</a>
                <input type="text" name="query" value="" placeholder="映画名、レビュー内ワード">
                <a class="js-search-submit">検索する</a>
              </div>
              <p class="search__alert js-search-alert"></p>
            </form>
            <p class="search__separate search__title">
              <span class="search__title-inner">キーワード OR 条件検索</span>
            </p>
            <form class="search__form js-form-condition">
              <input type="hidden" name="class" value="moviereview-review-list">
              <input type="hidden" name="country" value="">
              <input type="hidden" name="genre" value="">
              <input type="hidden" name="release" value="">
              <input type="hidden" name="runtime" value="">
              <input type="hidden" name="star" value="">              
              
              <p class="search__separate search__star js-search-star"></p>
              <p class="search__separate search__genre js-search-genre">
                <?php              
                $html_genre = '';
                $term_array = mp_get_term_array('tmdb_genres');
                foreach ($term_array as $term) {
                  $html_genre .= '<a class="search__genre-link js-genre" data-genre="'.$term['slug'].'">'.$term['name'].'</a>';
                }
                echo $html_genre;
                ?>            
              </p>

              <p class="search__separate search__runtime">
                <span class="search__label">上映時間</span>
                <input type="range" class="js-runtime" value="" min="0" max="300">
                <input class="search__runtime-box js-runtime-text" type="text" value="">
              </p>

              <div class="search__separate search__release">
                <span class="search__label">公開年</span>
                <div class="js-search-release">
                  <select class="js-search-release-select">
                    <option value="all">---</option>
                  </select>
                  <span>〜</span>
                </div>
              </div>

              <!-- ここ数年、制作国情報は、TMDB API で返さないようなので検索から除外するため非表示にする -->
              <div class="search__separate search__country" style="display: none;">
                <span class="search__label">制作国</span>
                <select class="search__country js-search-country">
                  <option value="all">---</option>
                  <?php
                  $html_country = '';
                  $term_array = mp_get_term_array('tmdb_countries');
                  foreach ($term_array as $term) {
                    $html_country .= '<option class="js-country" value="'.$term['slug'].'">'.$term['name'].'</option>';
                  }
                  echo $html_country;
                  ?>            
                </select>
              </div>

              <p class="search__action search__action--condition">
                <span class="search__action-clear">
                  <a class="js-search-clear" data-type="condition">クリア</a>
                </span>
                <span class="search__action-submit">
                  <a class="js-search-submit">検索する</a>
                </span>
              </p>

              <p class="search__alert js-search-alert"></p>
            </form>
          </div>
        </div>
      </div>
      <div class="search__close">
        <a class="search__close-link js-search-close">
          <span class="icon-close"></span>
        </a>
      </div>
    </div>
    
    <nav class="nav js-nav">
      <h1 class="nav__menu">
        <a href="/blog/"><span class="icon-b"></span></a>
      </h1>
      <div class="nav__search">
        <a class="js-search-open"><span class="icon-search"></span></a>
      </div>
    </nav>    
    
    <div class="cover"></div>

    
    <footer class="footer">
      <div class="footer__grid">
        <section class="profile">
          <h1 class="profile__title">Profile</h1>
          <div class="profile__flex">
            <figure class="profile__figure"></figure>
            <div class="profile__text">
              <h2 class="profile__name">Taketake</h2>
              <div class="profile__intro">
                <p>1975年生まれ。本名:川上武範（かわかみたけのり）。通称たけたけ。仙台生まれ、埼玉育ち、東京暮らし。趣味で短編自主映画作りをする（最近では制作する機会は減っているが、いつでも制作できるように映像制作や編集、写真撮影、映画鑑賞は続けている）。40歳で脱サラして個人事業主「シンプルシンプルデザイン」として起業するも46歳で人生最大のピンチで極貧生活に陥る。大逆転できるか分からないが、どうにかしようともがいている。</p>
                <div>
                  <ul class="profile__sns sns">
                    <li><a href="https://www.youtube.com/channel/UCIVjgwC-a0sz1ckYC9es1rw" target="_blank"><span class="icon-youtube"></span></a></li>
                    <li><a href="https://www.instagram.com/tabinoto/" target="_blank"><span class="icon-instagram"></span></a></li>
                    <li><a href="https://www.facebook.com/filmpathy" target="_blank"><span class="icon-facebook"></span></a></li>
                    <li><a href="https://twitter.com/filmpathy" target="_blank"><span class="icon-twitter"></span></a></li>
                    <li><a href="https://simplesimples.com/" target="_blank"><span class="icon-sphere"></span></a></li>                
                  </ul>
                  <p>Thank you for following and subscribe to me.</p>
                </div>
                <p>&raquo; <a href="https://youtube.com/playlist?list=PLKZ3KBHoIJT7xSP1td8AvHO1BApDk_2II" target="_blank">まだ観てない気になる映画予告集(YouTube)</a></p>
              </div>
            </div>
          </div>
        </section>
        
        <div>
          <section class="credits">
            <h1 class="credits__title">Credits</h1>
            <dl>
              <dt>
                <a href="https://www.themoviedb.org/" target="_blank">
                  <img class="credits__tmdb" src="<?php echo ASSETS_PATH; ?>/images/tmdb.svg" alt="The Movie Database">
                </a>
              </dt>
              <dd>このプロダクトはTMDB APIを使用していますが、TMDBによって承認または認定されていません。</dd>
              <dd class="credits__en">This product uses the TMDB API but is not endorsed or certified by TMDB.</dd>
            </dl>
          </section>
          <section class="credits">
            <h1 class="credits__title">Contact</h1>
            <dl>
              <dt>自分の映画レビューサイトを作りたい方へ</dt>
              <dd>この映画レビューサイトと同じデザインでよければ、あなた専用の映画レビューサイトを作らせていただきます。具体的には本番公開までの設定をサポートします（機能追加や変更は対象外）。費用はレンタルサーバー（＋ドメイン）代のみでサポート料はいただきません。<br>ご質問や気になった方は「Movie Reviewの件」と題して、メールにてご連絡ください。<br>MAIL: <a href="mailto:simplesimplesdesign@gmail.com">simplesimplesdesign@gmail.com</a></dd>
            </dl>
            <p><br></p>
          </section>
        </div>
      </div>
      
      <h1 class="footer__title"><?php echo $posts_count; ?>Movie Reviews by Taketake</h1>
      <p class="footer__copyright">
        <small>SINCE 2015&copy;シンプルシンプルデザイン</small>
        <small>SINCE 2015&copy;たびのと</small>
        <small>SINCE 2006&copy;個人ブログ</small>
      </p>
    </footer>
    
    
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>