<section class="nav-section">
  <div class="nav-section__inner">
    <h1 class="nav-section__title">WEB制作・映像制作のブログ</h1>
    <section class="nav-section__list">
      <h1 class="nav-section__list-title">最新記事</h1>
      <div class="nav-list">
        <div class="nav-list__inner">
          <?php    
          $posts = get_posts(array(
            'posts_per_page' => 15
          ));
          ?>
          <?php if ($posts): foreach($posts as $post): setup_postdata($post); ?>
          <?php echo mp_get_post_for_list(get_the_id()); ?>
          <?php endforeach; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
    <section class="nav-section__list">
      <h1 class="nav-section__list-title">よく読まれている記事</h1>
      <div class="nav-list">
        <div class="nav-list__inner">
          <?php
          /*
           * プラグイン「WordPress Popular Posts」を有効にするとある関数
           */
          if (function_exists('wpp_get_mostpopular')) {
            $arg = array (
              'limit' => 15,    // 記事を表示する最大件数
              'range' => 'monthly',   // 集計期間。 daily, weekly, monthly, all のいずれかを指定     
              'order_by'  => 'views',   // ソート順の対象。 views(閲覧数), comments(コメント数), avg(1日の平均）のいずれかを指定
              'post_type' => 'post',    // ポストタイプを指定。post, page, などを指定
            );
            wpp_get_mostpopular($arg);
          }
          ?>
        </div>
      </div>
    </section>
    <section class="nav-section__list">
      <h1 class="nav-section__list-title">最近コメントありの記事</h1>
      <div class="nav-list">
        <div class="nav-list__inner">
          <?php echo mp_comment_list(); ?>
        </div>
      </div>
    </section>
  </div>
</section>