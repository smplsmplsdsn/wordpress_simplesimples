$(function () {  
  const _entry_error = $('.js-entry-error-2'),
        _movie_title = $('input[name="movie_title"]'),
        _entry_link = $('.js-entry-update'),
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

        _entry_link.html('<span class="animation-blinker">更新中...</span>');
        
        $.ajax({
          url: '/api/?class=moviereview-entry-data',
          type: "POST",
          data: {
            post_id: $('input[name="post_id"]').val(),
            movie_title: movie_title,
            youtube: $('input[name="youtube"]').val(),
            amazon: $('input[name="amazon"]').val()
          },
          dataType: "html",
          timespan: 5000
        })
        .done(function(d) {
          if (isNumber(d) && (+d) > 0) {

          } else {
            _entry_error.html('更新できませんでした。ERROR CODE 101').show();
          }          
        })
        .fail(function(e){
          _entry_error.html('更新できませんでした。ERROR CODE 102').show();
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
