$(function () {
  
  const _comment = $('.js-comment'),
        _prevnext = $('.js-prevnext'),
        _footer = $('.js-footer'),
        _link_menu = $('.js-link-menu');
  
  let pos = 0;
  
  $(window).scroll(function () {
    let pos_new = window.pageYOffset,
        h_view = window.innerHeight,
        pos_screen = pos_new + h_view,
        h = document.documentElement.scrollHeight,
        pos_comment = 0,
        pos_footer = 0;
        
    
    // コメントエリアを表示したら、画面上部に前後記事を表示する
    if (_comment.length > 0 && _prevnext.length > 0) {
      pos_comment = _comment.offset().top;

      if ((pos_comment - h_view*0.4 - pos_new < 0 && pos_new > pos) || h <= pos_screen) {
        _prevnext.addClass('show');
      } else {
        _prevnext.removeClass('show');
      }
    }
    
    
    // フッターエリアになったら、ページトップにする
    if (_footer.length > 0 && _link_menu.length > 0 && !_link_menu.hasClass('moving')) {
      pos_footer = _footer.offset().top;
      
      if (pos_footer - pos_screen > 0) {
        _link_menu.removeClass('on');
      } else {
        _link_menu.addClass('on');
      }
    }
    
    
    pos = pos_new;  // pos更新
  });
  
});