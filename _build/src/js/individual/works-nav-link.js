$(function () {
  
  $('.js-works-nav-link').on('click', function () {
    let tgt = $(this).attr('data-type');
        
    pageScroll($('.js-works-nav[data-type="' + tgt + '"]').offset().top);
    return false;
  });
});
