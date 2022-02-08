<footer class="footer js-footer">
  <p class="footer__topicpath">
    <a href="/"><span class="icon-home"></span></a>
    <a href="/blog/">BLOG</a>
    <?php if (!is_page()): ?>
    <a href="/<?php echo get_post_type_object(get_post_type()) -> name; ?>/"><?php echo get_post_type_object(get_post_type()) -> label; ?></a>
    <?php endif; ?>
    <?php if (is_single()): ?>
    <strong class="footer__topicpath-current"><?php the_title(); ?></strong>
    <?php endif; ?>
  </p>
  <div class="footer__copyright">
    <small>Since 2015&copy;Simple Simples Design</small>
    <small>Since 2015&copy;Tabinoto</small>
    <small>Since 2003&copy;Taketake's Blog</small>
  </div>
</footer>