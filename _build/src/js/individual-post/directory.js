/**
 * カテゴリー一覧
 * https://wpdocs.osdn.jp/%E3%83%86%E3%83%B3%E3%83%97%E3%83%AC%E3%83%BC%E3%83%88%E3%82%BF%E3%82%B0/wp_list_categories
 */
$(function () {
  
  $('.js-directory a').removeAttr('title').each(function () {
    let _this = $(this);
    
    if (_this.next().length > 0) {
      _this.removeAttr('href').addClass('directory__label');
    }
  });
});