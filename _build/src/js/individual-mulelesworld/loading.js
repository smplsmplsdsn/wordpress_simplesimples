$(function () {
  
  const _loading = $('.js-loading'),
        _body = $('.js-body');
  
  // TODO 画像読み込み後に変更する
  setTimeout(function () {
    _loading.fadeOut(() => {
      _loading.remove();
      _body.addClass('loaded');
    });
  }, 100);
});