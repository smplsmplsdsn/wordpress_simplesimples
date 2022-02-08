$(function () {  
  const _entry_error = $('.js-entry-error'),
        _movie_title = $('input[name="movie_title"]'),
        _entry_link = $('.js-entry-new'),
        text_link = _entry_link.html();
  
  let LOADING = false;

  _entry_link.on('click', function () {
    let movie_title = _movie_title.val().trim();
    
    _entry_error.hide();
    
    if (movie_title === '') {
      _entry_error.html('映画タイトルを入力してください。').show();      
    } else {
      
      if (!LOADING) {
        LOADING = true;

        _entry_link.html('<span class="animation-blinker">保存中...</span>');
        
        $.ajax({
          url: '/api/?class=moviereview-entry-data',
          type: "POST",
          data: {
            movie_title: movie_title
          },
          dataType: "html",
          timespan: 5000
        })
        .done(function(d) {
          if (isNumber(d) && (+d) > 0) {
            _entry_link.hide();
            $('input[name="post_id"]').val(d);
            $('.js-entry-edit-link').attr('href', '/wp-admin/post.php?post=' + d + '&action=edit');
            $('.js-entry-edit-view').show();
          } else {
            _entry_error.html('登録できませんでした。ERROR CODE 001').show();
          }
        })
        .fail(function(e){
          _entry_error.html('登録できませんでした。ERROR CODE 002').show();
        })
        .always(function(){
          LOADING = false;
          _entry_link.html(text_link);
        });        
      }
    }    
    
    return false;
  })
});
