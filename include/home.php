<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <?php include_once($theme_dir."/include/head.php"); ?>
  <body>
    <div class="home-header">
      <div class="home-header__inner">
        <h1 class="home-header__title"><img src="<?php echo ASSETS_PATH; ?>/images/simplesimplesdesign-a2.svg" alt="シンプルシンプルデザイン"></h1>
      </div>
    </div>
    
    <div class="home-mainvisual">
      <div class="home-mainvisual__inner">
        <section class="home-mainvisual__unit" style="background-image:url(<?php echo ASSETS_PATH; ?>/images/home-service-01.jpg);">
          <a class="home-mainvisual__link" style="background-image:url(<?php echo ASSETS_PATH; ?>/images/home-service-01.jpg);">
            <div>
              <!--
              <h1><span></span></h1>
              <p></p>
        -->
            </div>
          </a>
        </section>

        <section class="home-mainvisual__unit" style="background-image:url(https://www.shutterstock.com/ja/image-photo/system-engineering-concept-cording-cyber-security-1983455063);">
          <a class="home-mainvisual__link" style="background-image:url(https://www.shutterstock.com/ja/image-photo/system-engineering-concept-cording-cyber-security-1983455063);">
            <div>
              <h1></h1>
              <p></p>
            </div>
          </a>
        </section>

        <section class="home-mainvisual__unit" style="background-image:url(<?php echo ASSETS_PATH; ?>/ogp-moviereview.jpg);">
          <a class="home-mainvisual__link" style="background-image:url(<?php echo ASSETS_PATH; ?>/ogp-moviereview.jpg);">
            <div>
              <h1><span>映画レビューに最適なブログテンプレート</span></h1>
              <p></p>
            </div>
          </a>
        </section>
      </div>      
    </div>
    
    <!--
    <section class="home-section">
      <div class="home-section__inner">
        <h1 class="home-section__title">サービス紹介</h1>
        
        
      </div>
    </section>
    -->
    <div class="home-section">
      <div class="home-section__inner">
        <div class="home-grid home-grid--3">
          <section class="home-section">
            <a class="home-section__link-figure" href="/service/">
              <figure class="home-section__figure" style="background-image:url(<?php echo ASSETS_PATH; ?>/images/icon-service.jpg);"></figure>
            </a>
            <div>
              <h1 class="home-section__title">サービス紹介</h1>
              <p>サービス内容を見直しました。「教え方が上手い」「説明が分かりやすい」と言っていただくことが多かったので、情報共有コンテンツを強化します。また企業紹介やサービス紹介の動画撮影・編集も積極的に取り組みます。</p>
              <p class="home-section__more"><a href="/service/" title="サービス紹介">もっとみる</a></p>
            </div>
          </section>
          <section class="home-section">
            <a class="home-section__link-figure" href="/works/">
              <figure class="home-section__figure" style="background-image:url(<?php echo ASSETS_PATH; ?>/images/icon-works.png);"></figure>
            </a>
            <div>
              <h1 class="home-section__title">制作実績</h1>
              <p>個人事業主として起業後の公開できるクライアントワークやWEB業界に関わるようになってからセルフワーク、セルフコンテンツ、このブログのリニューアルヒストリーをリスト化しています。</p>
              <p class="home-section__more"><a href="/works/" title="制作実績">もっとみる</a></p>
            </div>
          </section>
          <section class="home-section">
            <a class="home-section__link-figure" href="/about/">
              <figure class="home-section__figure" style="background-image:url(<?php echo ASSETS_PATH; ?>/images/icon-about.jpg);"></figure>
            </a>
            <div>
              <h1 class="home-section__title">事業のこと</h1>
              <p>「楽しくするためにできることを仕事に」をビジョンに、「人に優しく、自分に厳しく、助け合い、楽しくする」ことを心がけています。</p>
              <p class="home-section__more"><a href="/about/" title="事業のこと">もっとみる</a></p>
            </div>
          </section>
        </div>
      </div>
    </div>
    
    <section class="home-section">
      <div class="home-section__inner">
        <h1 class="home-section__title">WEB制作・映像制作のブログ</h1>
        <section class="home-section__list">
          <h1 class="home-section__list-title">最新記事</h1>
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
        <section class="home-section__list">
          <h1 class="home-section__list-title">よく読まれている記事</h1>
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
        <section class="home-section__list">
          <h1 class="home-section__list-title">最近コメントありの記事</h1>
          <div class="nav-list">
            <div class="nav-list__inner">
              <?php echo mp_comment_list(); ?>
            </div>
          </div>
        </section>
      </div>
    </section>
    
    <div class="inner">
    </div>
    
    <?php include_once($theme_dir."/include/footer.php"); ?>
    <?php include_once($theme_dir."/include/js.php"); ?>    
  </body>
</html>
