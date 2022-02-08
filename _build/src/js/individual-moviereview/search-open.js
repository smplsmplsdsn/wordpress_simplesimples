/**
 * 検索エリアを表示する
 */
$(function () {
  const _search_open = $('.js-search-open'),
        _search = $('.js-search'),
        _nav = $('.js-nav');
  
  _search_open.on('click', function () {
    viewPause('searching', true);
    _search.scrollTop(1);
    _nav.hide();
    
    return false;
  });
});