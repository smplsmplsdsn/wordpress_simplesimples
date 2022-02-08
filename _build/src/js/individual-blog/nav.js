/**
 * 上にスクロール、スクロールが停止したときにナビを表示する
 */
const nav = () => {
  const _nav = $('.js-nav'),
        _footer = $('.js-footer'),
        act = (IS_TOUCH)? 'scroll': 'scrollstop',
        interval = (IS_TOUCH)? 1000: 2000;
  
  let pos = 0,
      is_stop;
  
  $(window).on(act, () => {
    let new_pos = window.pageYOffset,
        footer_pos = _footer.offset().top;
    
    if (new_pos < pos || (new_pos + window.innerHeight > footer_pos)) {
      _nav.addClass('view');      
    } else {
      _nav.removeClass('view');      
    }
    
    if (is_stop) clearTimeout(is_stop);
    is_stop = setTimeout(function () {
      let re_pos = window.pageYOffset;
      
      if (re_pos == new_pos) {
        _nav.addClass('view');
      }
      
    }, 1000);

    pos = new_pos;
  }); 
}
