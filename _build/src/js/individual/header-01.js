/**
 * トップページのヘッダーに有効
 * 大きめのヘッダーでスクロールすると小さくなる
 */
$(function () {
  const _header = $('.js-header-01');
  
  let pos = 0,
      is_init = true; // ファイル読み込み時は処理しない
  
  $(window).on('scrollstop', function () {
        
    let padding = _header.css('padding-top'),
        padding_num = parseInt(padding);
    
    if (is_init) {
      is_init = false;
    } else {
      pos = window.pageYOffset;
      if (pos > 1 + padding_num*2) {
        _header.addClass('no-top');
      } else {
        _header.removeClass('no-top');
      }      
    }   
  });
});