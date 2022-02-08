/**
 * レビュー情報を取得する
 * ATTENSION 前提: MOVIE_INFO
 *
 * @param (string) next_link* Ajaxリンク
 * @return (object) 記事情報
 */
let PAGERING;   // AJAX中に読み込み済みのユニットを呼び出した場合にAJAX中のユニットを無効にするためのフラグ

const getList = (pager_link) => {
  
  const next_url = DOMAIN + pager_link.attr('data-next'),
        _pager = $('.js-pager'),
        _list = $('.js-list'),
        _load_list = $('.js-load-list');
    
  if (!PAGERING) {
    PAGERING = true;
    pager_link.html('<span class="animation-blinker">loading...</span>');    
    
    $.ajax({
      url: next_url,
      type: "GET",
      dataType: "html",
      timespan: 5000
    })
    .done(function(d) {
      
      if (d === 'zero') {
        
        // NOTICE 検索結果かMOREか判別する必要がある
        if ($('.js-unit', _list).length > 0) {
          $('.js-pager').css({visibility: 'hidden'});
        } else {
          // TODO 検索結果ZEROの場合 
        }
      } else {
        _load_list.html(d);
        setList();
        
        // スクロール位置をずらす
        pageScroll(window.pageYOffset + 50, 650);
      }
    })
    .fail(function(){
    })
    .always(function(){
      PAGERING = false;
    });
  } 
}
