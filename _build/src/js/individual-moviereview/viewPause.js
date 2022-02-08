/**
 * 画面を表示位置で固定・解除する
 *
 * @param (string) view* 表示する画面 
 * @param (boolean) is_detail true: 固定 false: 固定もしくは解除
 */
let POS_PAUSING = 0;
const viewPause = (view, is_detail) => {
  const _html = $('html'),
        _nav = $('.js-nav');
  
  if (_html.hasClass(view) && !is_detail) {
    _html.removeClass(view);    
    
    setTimeout(function () {
      _nav.show();
    }, 650);
  } else {
    POS_PAUSING = window.pageYOffset;
    _html.addClass(view);   
  }
  window.scrollTo(0, POS_PAUSING);
}

