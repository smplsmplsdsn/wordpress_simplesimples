/**
 * レビュー情報を取得する
 * ATTENSION 前提: MOVIE_INFO
 *
 * @param (string) post_id* 投稿ID
 * @return (object) 記事情報
 */
let SETUNITING;   // AJAX中に読み込み済みのユニットを呼び出した場合にAJAX中のユニットを無効にするためのフラグ

const setUnit = (post_id) => {
  const _nav = $('.js-nav');
  
  if (post_id) {
    viewPause('detailing', true);   // 表示位置を固定する    
    _nav.hide();  // ナビを非表示にする
    
    if (MOVIE_INFO[post_id]) {
      setUnitCording(post_id);
      SETUNITING = false;
    } else {
      SETUNITING = true;
      $.ajax({
        url: '/api/',
        type: "GET",
        dataType: "json",
        data: {
          'class': 'moviereview-review',
          'movie_id': post_id
        },
        timespan: 5000
      })
      .done(function(d) {
        
        if (SETUNITING) {
          if (d && d.title) {
            MOVIE_INFO[post_id] = d;
            setUnitCording(post_id);
          } else {
            setUnitCording();
          }          
        }
      })
      .fail(function(){
        setUnitCording();
      })
      .always(function(){
        SETUNITING = false;
      });
    }
  } 
}
