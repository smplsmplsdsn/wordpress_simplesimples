<?php
/*
 * ATTENSION 事前に準備しておく必要がある変数
 *
 * $view_type
 */
?>
<script>
const DOMAIN = '<?php echo DOMAIN; ?>';
</script>

<script type="text/javascript" src="<?php echo ASSETS_PATH; ?>/js/<?php echo $view_type; ?>.min.js?t=<?php echo filemtime(ASSETS_LOOT."/js/".$view_type.".min.js"); ?>"></script>
<script>
<?php if (is_single()): ?>  
<?php the_field("javascript"); ?>
<?php endif; ?>
</script>
  
