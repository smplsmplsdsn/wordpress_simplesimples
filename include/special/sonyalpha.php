<?php
$head_ogp_img = ASSETS_PATH.'/ogp.png';
$head_title = "Sony α 一眼ミラーレスカメラ";
$head_description = "α 一眼ミラーレスカメラの初値と最安値を調べて、周りに流されない自分軸で買い時を判断したい！";
$view_type = 'sony';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
  </head>
  <body>
    
    
    <h1 class="title">SONY α　一眼ミラーレスカメラ</h1>

    <div class="chronology js-chronology">
      <div class="chronology__inner js-chronology-inner"></div>
    </div>
    
    <div class="camera js-camera">
      <div class="camera__inner js-data"></div>
    </div>    
    
    <form class="form js-form">
      <label><input type="radio" name="series" value="all"><span>すべて</span></label>
      <label><input type="radio" name="series" value="a7all"><span>α7シリーズ</span></label>
      <label><input type="radio" name="series" value="a1"><span>α1</span></label>
      <label><input type="radio" name="series" value="a9"><span>α9</span></label>
      <label><input type="radio" name="series" value="a7s"><span>α7S</span></label>
      <label><input type="radio" name="series" value="a7r"><span>α7R</span></label>
      <label><input type="radio" name="series" value="a7"><span>α7</span></label>
      <label><input type="radio" name="series" value="a"><span>α(ほか)</span></label>
      <label><input type="radio" name="series" value="aps"><span>APS-C</span></label>
    </form>
    
    <div class="js-loading splash"><span class="animation-blinker">loading...</span></div>
    
    <script>
      const ASSETS_PATH = '<?php echo ASSETS_PATH; ?>';      
    </script>    
    <?php include_once($theme_dir."/include/js.php"); ?>    
  </body>
</html>