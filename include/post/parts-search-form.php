<?php
/**
 * ATTENSION GETパラメータ
 * $s, $post_type
 */
?>
<div class="search">
  <form class="search__form" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" name="s" value="<?php echo $s; ?>" placeholder="サイト内検索">
    <input type="hidden" name="post_type" value="<?php echo $post_type; ?>">
  </form>
</div>
