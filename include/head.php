<?php
/*
 * ATTENSION 事前に準備しておく必要がある変数
 *
 * $head_title
 * $head_ogp_img
 * $head_description
 * head_type
 */
if (!isset($head_manifest)) {
  $head_manifest = 'manifest';
}
?>
<head>
  <meta charset="utf-8">
  <title><?php echo $head_title; ?></title>
  <?php include_once("google.php"); ?>
  <meta name="robots" content="ALL">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">
  <meta property="og:image" content="<?php echo $head_ogp_img; ?>">
  <meta name="description" content="<?php echo $head_description; ?>">
  <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">  
  <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon/style.css"); ?>">
  <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
  <?php if (isset($canonical)): ?>
  <link rel="canonical" href="<?php echo $canonical; ?>">
  <?php elseif (is_singular('post') || is_page()): ?>
  <link rel="canonical" href="<?php echo get_permalink(); ?>">
  <?php endif; ?>
  <style><?php the_field("stylesheet"); ?></style>
  <?php
  if (isset($head_javascript)) {
    echo $head_javascript;
  }
  ?>
  <?php wp_head(); ?>
</head>
