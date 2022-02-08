/*
 * NOTICE: 応急処置 is_show_for_android
 * Androidでは、fixでダイアログ表示した際、fix配下のリンクをアクティブにしてしまう
 * バブリングと同じ状況になるため、擬似的に下のリンクを無効になるように設定
 */
const photoInit = () => {
    
  let pos = 0,
      is_click,
      is_show_for_android;

  $('.js-photo-slide')
  .on(eventstart, function () {
    is_click = true;
  })  
  .on(eventmove, function() {
    is_click = false;
  })
  .on(eventend, function () {
    let num = $(this).attr('data-no') || '<?php echo $photo_first_no; ?>';

    if (is_click) {
      is_show_for_android = true; 
      $('html').removeClass('fix');

      if (pos > window.innerHeight && num != '') {
        pos = $('img.js-slide-link[data-nav="' + num + '"]').offset().top - 100;              
      }
      window.scrollTo(0, pos);
      setTimeout(function () {
        is_show_for_android = false;
      }, 350);
    }
  });

  $('.js-content img').each(function (n) {
    $(this).addClass('js-slide-link').attr('data-nav', n + 1).css({cursor: 'pointer'});
  })

  $('.js-slide-link').on('click', function () {
    if (!is_show_for_android) {
      pos = window.pageYOffset;
      $('html').addClass('fix');            
    }
    return false;
  });

  slide.show();
}
