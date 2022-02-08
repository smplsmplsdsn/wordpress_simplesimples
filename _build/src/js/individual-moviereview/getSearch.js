/**
 * 検索
 *
 * @param (string) search_type 検索タイプ（フリーワードか条件か）
 */
let SEARCHING;
const getSearch = (search_type = 'freeword') => {
  const _form_search = (search_type === 'freeword')? $('.js-form-freeword-search'): $('.js-form-condition'),
        _search_alert_all = $('.js-search-alert'),
        _search_alert = $('.js-search-alert', _form_search),
        _search_submit = $('.js-search-submit', _form_search),
        _condition = $('.js-condition'),
        _list = $('.js-list'),
        _load_list = $('.js-load-list');
  
  let text_alert = '',
      text_condition = '',
      form_data = _form_search.serializeArray();
    
  if (!SEARCHING) {
    SEARCHING = true;
    
    _list.css({opacity: 0});
    _search_alert_all.html('');
    _condition.hide();
    _search_submit.html('<span class="animation-blinker">loding...</span>');
        
    $.ajax({
      url: '/api/',
      type: "GET",
      data: form_data,
      dataType: "html",
      timespan: 5000
    })
    .done(function(d) {
      let unit_adjust_num,
          unit_num,
          w = window.innerWidth;
      
      // 検索中に検索ビューが閉じられていないか判別する
      if (SEARCHING) {
        
        if (d === 'zero') {
          text_alert= (search_type === 'freeword')? '該当する検索結果が見つかりませんでした。キーワードを変更して再度お試しください。': '該当する検索結果が見つかりませんでした。検索条件を変更して再度お試しください。';
          
        } else {
          _list.html('');
          _load_list.html(d);
          setList();
          
          // Attension htmlにセットされた後（setList()）に実行する必要あり
          text_condition = setConditionCording(search_type, form_data);
          if (text_condition != '') {
            _condition.html(text_condition).show();
          }

          // 検索結果数が少ない場合にレイアウト調整する
          if (w >= 760) {

            unit_num = $('.js-unit', _list).length;
            unit_adjust_num = Math.floor(w/220);

            if (unit_adjust_num > unit_num) {
              _list.addClass('list--less');
            } else {
              _list.removeClass('list--less');
            }
          }

          // 検索ビューを閉じる
          viewPause('searching');
          
          // NOTICE ページ先頭にするためにhide/showしている
          window.scrollTo(0, 1);

        }
      }      
    })
    .fail(function(){
      text_alert= 'うまく検索できなかったので、もう一度お試しください。';
    })
    .always(function(){
      SEARCHING = false;
      _list.css({opacity: 1});
      _search_alert.html(text_alert);
      _search_submit.html('検索する');
    });
  }
}