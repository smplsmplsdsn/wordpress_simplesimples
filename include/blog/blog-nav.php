<nav class="nav js-nav">
  <?php if (is_single()): ?>
  <div class="nav__prevnext">
  <?php
  $nextpost = get_adjacent_post(false, '', false);
  $prevpost = get_adjacent_post(false, '', true);

  function get_prevnext($data, $arrow) {
    $str = '';
    if ($data) {
      $id = $data -> ID;
      $str .= '<a href="'.get_the_permalink($id).'"><span class="icon-arrow-'.$arrow.'"></span></a>';
    } 
    return $str;
  }
  echo get_prevnext($prevpost, 'left');
  echo get_prevnext($nextpost, 'right');

  ?>
  </div>
  <?php endif; ?>
  <div class="nav__menu">
    <a href="/blog/"><span class="icon-b"></span></a>
    <?php if (is_single()): ?>
    <a href="/<?php echo get_post_type_object(get_post_type()) -> name; ?>/"><span class="icon-menu"></span></a>
    <?php endif; ?>
  </div>
</nav>