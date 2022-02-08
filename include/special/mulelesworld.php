<?php
$head_ogp_img = ASSETS_PATH.'/ogp.png';
$head_title = "Welcome to Mulele's World";
$head_description = "";
$view_type = 'mulelesworld';
?>
<!doctype html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <title><?php echo $head_title; ?></title>
    <?php include_once($theme_dir."/include/google.php"); ?>
    <meta name="robots" content="ALL">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <meta property="og:image" content="<?php echo $head_ogp_img; ?>">
    <meta name="description" content="<?php echo $head_description; ?>">
    <link rel="shortcut icon" href="<?php echo ASSETS_PATH; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_PATH; ?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/<?php echo $view_type; ?>.min.css?t=<?php echo filemtime(ASSETS_LOOT."/css/".$view_type.".min.css"); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body class="js-body">
    
    <div class="container">

      <h1 class="title"><img src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/mulelesworld.svg" alt="Welcome to Mulele's World"></h1>

      <div class="mainvisual">

        <div class="mainvisual__ex">
          <figure class="mainvisual__upload">
            <img class="mainvisual__img" src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/upload.jpg">
          </figure>
          <img class="mainvisual__arrow" src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/arrow.png">
          <p class="mainvisual__copy">
            <span>あなたの顔写真が、<span class="nowrap">一枚の</span>イラストに！Muleleの世界観で<span class="nowrap">生まれ</span>変わります！</span>
          </p>
        </div>

      </div>

      <section class="flow">
        <h1 class="flow__title"><img src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/choose.svg" alt="Choose your favorite!"></h1>          
        <p class="flow__ex">決めることは3つだけ。</p>
        <ol class="flow__checklist">
          <li>いつの時代に登場したいか</li>
          <li>仕上がりの構図はどうしたいか</li>
          <li>あなたの顔写真を用意する</li>
        </ol>

        <div class="form">

          <?php
            if ($is_honban) {
              $contact_form_7 = '[contact-form-7 id="6678" title="Mulele\'s World"]';
            } else {
              $contact_form_7 = '[contact-form-7 id="6514" title="Mulele\'s World"]';
            }
            echo do_shortcode($contact_form_7);
          ?>

          <div class="form__message">
            <p class="form__attention">申し込み後に、ご記入のメールアドレス宛てに、お支払いのご案内を自動返信メールさせていただきます。<br>
            メールが届かない場合は、お手数をおかけしてすいませんが、下記までご連絡くださいませうようよろしくお願いいたします。<br>
            <a href="mailto:simplesimplesdesign@gmail.com">simplesimplesdesign@gmail.com</a><br>担当: かわかみ</p>
          </div>
        </div>

        <section class="flow__ex">
          <h1>申し込みからイラストデータを受け取るまで</h1>
          <ol>
            <li>申し込み画面から、必要項目を入力の上、申し込む</li>
            <li>料金のお支払いに関するご案内を自動メールにてご連絡します。(*1)</li>
            <li>料金の支払いをお願いします。(*1)</li>
            <li>顔写真とお支払いを確認しましたら、申し込み順に、Muleleによるイラスト制作させていただきます。<br>黒単色のイラストとなります。</li>
            <li>イラスト完成後、メールにてデジタルデータをお送りします。(*2)</li>
          </ol>
          <p class="flow__attention">*1 現在、お支払い方法は、PayPay払いのみとなります。またイベント時には現場にて現金でご対応させていただくことも可能です。</p>
          <p class="flow__attention">*2 デジタルデータはA4サイズ(解像度300dpi)のJPEG形式となります。</p>
          <p class="flow__message">プリントアウトして飾ったり、SNSのプロフィール画像にしたり、デジタルデータなのでさまざまな形でご利用いただけます。</p>
        </section>        
      </section>
      
    </div>

    <aside class="condition">
      <div class="container">
        <h1>お申し込み条件</h1>
        <ul>
          <li>顔写真とご入金を確認後、お申し込みが完了となります。</li>
          <li>Muleleの制作実績として、MuleleのインスタやWebサイトに作品を掲載することがあります。また今後のMuleleの作品に登場するかもしれません。もちろん、添付いただいた写真を許可なく無断で公開することはありませんのでご安心ください。</li>
          <li>申し込み後のキャンセルは、制作前：100%返金、制作開始後: 50〜80%の手数料を差し引いた額を返金(完成度具合で変動)させていただきます。完成後のキャンセルはご対応致しかねます。</li>
          <li>作品をどのようにご利用いただいても問題ありませんが、商品として販売することは禁止させていただきます。</li>
          <li>予告なくお申し込み条件を変更することがあります。</li>
        </ul>
        <p>2022年1月21日 施行</p>
      </div>
    </aside>

    <aside class="profile">
      <div class="container">
        <img src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/portrait.jpg">
        <div>
          <h1>Mulele Jarvis</h1>
          <p>New York, San Francisco and Tokyo — all have served as home to Mulele Jarvis at various lifepoints; and the distinct cultures in each of these cities has contributed to shaping his unique vision. Using elegant layerings of past, present and future, Mulele creates a temporal surrealism that gives visual form to the impact of mythos and memory on the urban experience in a multi-cultural world. “It’s all just grist for popular culture,” Mulele says. “There’s an obsession with American and Japanese film behind my work, shorn up by a plethora of music, a smattering of comics and truckload of Ramen.”</p>
          <p><a href="https://www.instagram.com/muleleredux/">Instagram</a></p>
        </div>
      </div>
    </aside>

    <div class="miguel" style="display: none;">
      <img class="miguel__img" src="<?php echo ASSETS_PATH; ?>/images/special/mulelesworld/miguel.svg">
    </div>

    <footer class="footer">

      <p class="footer__copyright">
        <small>(c) Mulele Redux</small>
      </p>
    </footer>
    
    <div class="js-loading loading">
      <span class="animation-blinker">loading...</span>
    </div>    
    
    <?php wp_footer(); ?>
    
    <script>
      const ASSETS_PATH = '<?php echo ASSETS_PATH; ?>';      
    </script>    
    <?php include_once($theme_dir."/include/js.php"); ?>    
  </body>
</html>