$(function () {
  const _nav = $('.js-nav');
    
  $('.js-nav-link').on('click', function () {
    _nav.addClass('on');
    return false;
  });
});