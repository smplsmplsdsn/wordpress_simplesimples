<?php
// head タイトル
$head_title = "音声入力ツール - シンプルシンプルデザイン";

// head 概要文
$head_description = "iPhoneで音声入力して簡単に編集したくて制作。";
?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <?php include_once($theme_dir."/include/head.php"); ?>
  <body class="voiceentry">
    
    <nav class="voiceentry__tabbar js-ve-tabbar-form">
      <div class="voiceentry__tabbar-inner">
        <span><a class="voiceentry__tabbar-clear js-ve-link-clear">リセット</a></span>
        <span><a class="voiceentry__tabbar-add js-ve-link-add"><span class="icon-plus"></span></a></span>
        <span><a class="voiceentry__tabbar-preview js-ve-link-preview">プレビュー</a></span>
      </div>
    </nav>
    
    <nav class="voiceentry__tabbar voiceentry__tabbar--preview js-ve-tabbar-preview">
      <div class="voiceentry__tabbar-inner">
        <span><a class="voiceentry__tabbar-back js-ve-link-back">戻る</a></span>
        <span><a class="voiceentry__tabbar-selected js-ve-link-copy">本文コピー</a></span>
      </div>
    </nav>
        
    <div class="voiceentry__form js-ve-form"></div>
    
    <div class="voiceentry__preview js-ve-preview">
      <div class="voiceentry__preview-inner">
        <textarea class="js-ve-copy-textarea" readonly></textarea>
      </div>
    </div>
    
    <div class="voiceentry__clone js-ve-clone">
      <section class="js-ve-unit">
        <p>
          <a class="js-ve-del"><span class="icon-trash"></span></a>
        </p>
        <div>
          <textarea class="js-ve-textarea"></textarea>
        </div>
        <nav>
          <a class="js-ve-up"><span class="icon-arrow-up"></span></a>
          <a class="js-ve-down"><span class="icon-arrow-down"></span></a>
        </nav>
      </section>    
    </div>
    
    <?php include_once($theme_dir."/include/js.php"); ?>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>/js/voiceentry.js"></script>

  </body>
</html>