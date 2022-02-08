<?php
/*
 * ATTENSION 事前に準備しておく必要がある変数
 *
 * $head_title
 * $head_ogp_img
 * $head_description
 * head_type
 *
 * $view_type   // functions/original/view_and_post_type.php
 * $mainifest   // single.php
 */
$head_robots = (isset($is_hide_robots))? 'NONE': 'ALL';
if (!isset($head_manifest)) {
  $head_manifest = 'manifest';
}
?>
<head>
  <meta charset="utf-8">
  <title><?php echo $head_title; ?></title>
  <?php include_once($theme_dir."/include/google.php"); ?>
  <meta name="robots" content="<?php echo $head_robots; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">
  <meta property="og:image" content="<?php echo $head_ogp_img; ?>">
  <meta name="description" content="<?php echo $head_description; ?>">
  <link rel="manifest" href="<?php echo ASSETS_PATH; ?>/<?php echo $head_manifest; ?>/manifest.json">
  <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/icomoon-<?php echo $view_type; ?>/style.css?t=<?php echo filemtime(ASSETS_LOOT."/icomoon-".$view_type."/style.css"); ?>">
  <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
  <style><?php the_field("stylesheet"); ?></style>
  <?php if (is_singular('post')): ?>
  <link rel="canonical" href="<?php echo get_permalink(); ?>">
  <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/highlight/styles/github-dark.min.css">
  <script src="<?php echo ASSETS_PATH; ?>/highlight/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>	
  <?php endif; ?>
  <?php
  if (!isset($is_hide_head)) {
    wp_head();
  }
  ?>
</head>
