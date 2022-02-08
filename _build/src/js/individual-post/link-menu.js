/**
 * 画面下に固定表示しているメニューボタンをクリックした際の振る舞い
 * メニューの代わりにフッターを表示する
 * トグル式にして、フッターページ表示後はクリック前の位置に移動する
 *
 * ATTENTION when-scroll.js でフッター表示時とそれ以外で on の付け外しをしている
 */
$(function () {
  const _footer = $('.js-footer');
  
  let pos = 0;
  
  $('.js-link-menu').on('click', function () {
    
    let _this = $(this),
        pos_footer = _footer.offset().top;
    
    _this.addClass('moving');
    
    if (_this.hasClass('on')) {
      _this.removeClass('on');
      pageScroll(pos, 300, function () {
        _this.removeClass('moving');
      });
    } else {
      _this.addClass('on');
      pos = window.pageYOffset;
      if (pos_footer < pos + window.innerHeight) {
        pos = 1;   
      }
      pageScroll(pos_footer, 300, function () {
        _this.removeClass('moving');
      });
    }
  });
});