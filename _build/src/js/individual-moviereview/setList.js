/**
 * リストを表示した際のリンク処理
 */
const setList = () => {
  const _load_list = $('.js-load-list'),
        _list = $('.js-list'),
        _detail_inner = $('.js-detail-inner');
  
  let _unit = $('.js-unit', _load_list),
      pager_link = $('.js-page-more', _load_list);
  
  
  /**
   * リストのリンクをクリックしたとき
   */
  const linkSetUnit = (post_id) => {
    
    _detail_inner.attr('data-id', post_id).html('<p class="detail__loading"><span class="animation-blinker">loading...</span></p>');  

    setUnit(post_id);  
    
    // history API
    historyPushState({post_id: post_id}, '', '/moviereview/?movie_id=' + post_id);      
  }
  
  // 呼び出したリストのJS処理を有効にする
  _unit.on(eventover, function () {
    $(this).addClass('hover');
  }).on(eventout, function () {
    $(this).removeClass('hover');
  }).on(eventend, function () {
    $(this).removeClass('hover');
  }).on('click', function () {
    let post_id = $('a', this).attr('data-id');
    
    linkSetUnit(post_id);
    return false;
  });
  
  $('a', _unit).on('click', function (e) {
    let post_id = $(this).attr('data-id');
    
    e.stopPropagation();    
    linkSetUnit(post_id);
    return false;
  });  
  
  _list.append(_unit);
  
  // ページャーリンク
  pager_link.on('click', function () {
    getList($(this));
    return false;
  });
}

