<?php
// JSON+LD イベントを Google のインデックスに登録する
// https://developers.google.com/search/docs/advanced/structured-data/event?hl=ja


// TODO 開催日　js schema rdf
$head_ogp_img = ASSETS_PATH.'/ogp.png';
$head_title = "オトナのアオハル展";
$head_description = "8人8色のグループ展";
$view_type = 'event';
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
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Event",
      "name": "<?php echo $head_title; ?>",
      "startDate": "2022-01-21T12:00-20:00",
      "endDate": "2022-01-23T12:00-18:00",
      "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
      "eventStatus": "https://schema.org/EventScheduled",
      "location": {
        "@type": "Place",
        "name": "自由帳ギャラリー",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "高円寺北2-18-11",
          "addressLocality": "杉並区",
          "postalCode": "1660002",
          "addressRegion": "東京都",
          "addressCountry": "日本"
        }
      },
      "image": [],
      "description": "<?php echo $head_description; ?>"
    }
    </script>
  </head>
  <body>
    <div class="main">
      <div class="works-list">
        <ul class="js-members-works"></ul>
      </div>
    </div>

    <div class="info">
      <h1 class="info__title"><img src="<?php echo ASSETS_PATH; ?>/images/event/otonanoaoharuten/title.png" alt="<?php echo $head_title; ?>"></h1>
      <h2 class="info__subtitle"><?php echo $head_description; ?></h2>
      
      <div class="info__column">
        <div class="info__content">

          <p class="info__date">
            1/21<span class="info__date-sub">(金)</span>12:00 - 19:00<br>
            1/22<span class="info__date-sub">(土)</span>12:00 - 18:30<br>
            1/23<span class="info__date-sub">(日)</span>12:00 - 16:30
          </p>
          <p style="margin: 1rem 0 0;">イベントは終了しました。<br>たくさんの方に足を運んでいただき、ほんとうにありがとうございました！</p>
          <p class="info__place">
            自由帳ギャラリー
            <span>杉並区高円寺北2-18-11<a href="https://goo.gl/maps/Hp5eNapTxcfUBB4d8" target="_blank">Google地図</a></span>
            <span>高円寺駅北口徒歩3分(およそ300m)</span>
          </p>
        </div>
        <div class="info__map">
          <img class="animation-blinker" src="<?php echo ASSETS_PATH; ?>/images/event/otonanoaoharuten/map-navi.svg?2">
        </div>
      </div>
    </div>
    
    <div class="works js-works">
      <div class="works__inner">
        <div class="works__view js-works-view"></div>
      </div>
      <a class="works__close js-works-close"><span>✖️</span></a>
    </div>
    
    <footer class="footer">
      <h1 class="footer__title">8人のクリエイター</h1>
      <ul class="footer__members members js-members-list"></ul>
      <small class="footer__copyright">&copy;<?php echo $head_title; ?></small>
    </footer>
    
    <script>
      const ASSETS_PATH = '<?php echo ASSETS_PATH; ?>';      
    </script>    
    <?php include_once($theme_dir."/include/js.php"); ?>    
    <script>
      const MEMBERS = [{
        'image': 'atelier_fuji_san.jpg',
        'icon': 'atelier_fuji_san.jpg',
        'name': 'Leonar do kuma',
        'insta': 'atelier_fuji_san'
      }, {
        'image': 'jurithedreamer.jpg',
        'icon': 'jurithedreamer.jpg',
        'name': 'じゅり',
        'insta': 'jurithedreamer'
      }, {
        'image': 'potto0143.jpg',
        'icon': 'potto0143.jpg',
        'name': '日本指し棒の会',
        'insta': 'potto0143'
      }, {
        'image': 'freeliferecord.jpg',
        'icon': 'freeliferecord.jpg',
        'name': 'freeliferecord-nico',
        'insta': 'freeliferecord'
      }, {
        'image': 'syk1kw29.jpg',
        'icon': 'syk1kw29.jpg',
        'name': 'きよっぺ',
        'insta': 'syk1kw29'
      }, {
        'image': 'aio_un2017tone.jpg',
        'icon': 'aio_un2017tone.jpg',
        'name': 'とね',
        'insta': 'aio_un2017tone'
      }, {
        'image': 'yuka.jpg',
        'icon': 'yuka.jpg',
        'name': 'ゆか',
        'insta': 'yuka_universe0302'
      }, {
        'image': 'sunnyside_accessory.jpg',
        'icon': 'sunnyside_accessory.png',
        'name': 'サニーサイドアクセサリー',
        'insta': 'sunnyside_accessory'
      }];
      
      const MEMBERS_SHUFFLE = arrayShuffle(MEMBERS);
      
    </script>
  </body>
</html>