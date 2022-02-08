<?php
// head ogp用画像
$head_ogp_img = mp_get_thumbnail();

// head タイトル
$head_title = "お探しのページは見つかりませんでした - シンプルシンプルデザイン";

// head 概要文
$head_description = "お探しのページは見つかりませんでした。";
?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <?php include_once($theme_dir."/include/post/parts-head.php"); ?>
  <body>
    
    <div class="wrapper">
      <div class="wrapper__inner">
        <div class="header">
          <?php include_once($theme_dir."/include/topicpath.php"); ?>
        </div>
        
        <div class="list">
          <?php include($theme_dir."/include/post/parts-search-form.php"); ?>
          
          <div class="list__header">
            <h1 class="list__title">お探しのページは見つかりませんでした。</h1>
            
            <div class="content content--error">
              <p>以下の状況が考えられます。</p>

              <ul>
                <li>指定されたページがない（削除、移動されている）。</li>
                <li>指定されたページへのアクセスが混み合っている。</li>
              </ul>

              <p>次のことをお試しください。</p>

              <ul>
                <li>サイト内検索を利用する。</li>
                <li>ページアドレス(URL)を正しく入力したか確認する。</li>
                <li>[ 更新ボタン ] をクリックして、再度読み込みをする。</li>
              </ul>			
            </div>
          </div>
          
          <?php if ($is_result): ?>
          <div class="grid grid--list">
            <?php if (have_posts()): while(have_posts()): the_post(); ?>
            <?php echo mp_html_list_unit(get_the_id()); ?>
            <?php endwhile; endif; ?>
          </div>
          <?php endif; ?>
          
        </div>        
      </div>
      
      <?php include_once($theme_dir."/include/post/parts-tabbar.php"); ?>
      <?php include_once($theme_dir."/include/post/parts-footer.php"); ?>
    </div>
    
    <?php include_once($theme_dir."/include/js.php"); ?>
  </body>
</html>