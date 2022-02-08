<footer class="footer js-footer">
  <?php include("parts-search-form.php"); ?>
  <div class="footer__inner">
    <div class="footer__notes">
      <?php
      $args = array(
        'post_type' => 'businessquotes',
        'posts_per_page' => 1,
        'orderby' => 'rand',
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()):
      while ($the_query->have_posts()): $the_query->the_post();
      endwhile;
      ?>
      <p class="businessquotes">
        <span class="businessquotes__text"><?php the_title(); ?></span>
        <span class="businessquotes__name"><?php the_field('word_name'); ?></span>
        <span class="businessquotes__business"><?php the_field('word_business'); ?></span>
      </p>
      <?php
      endif;
      wp_reset_query();
      ?>      
    </div>
    <nav class="footer__nav">
      <ul class="directory js-directory">
        <?php
        wp_list_categories(array(
          'title_li' => '',
          'depth' => 3,
          'current_category' => 1,
        ));
        ?>
      </ul>

    </nav>

    <div class="footer__legal">
      <small class="footer__copyright">&copy;<a href="/">Simple Simples Design</a></small>
    </div>
  </div>
</footer>
