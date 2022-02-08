$(function () {
  const _nav = $('.js-nav');
    
  $('.js-nav-close').on('click', function () {
    _nav.removeClass('on');
    return false;
  });
});