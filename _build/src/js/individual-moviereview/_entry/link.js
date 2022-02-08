$(function () {
  const _movie_title = $('input[name="movie_title"]');
  
  // YouTube予告リンク
  $('.js-entry-link-youtube').on('click', function () {
    
    let movie_title = _movie_title.val();
    
    window.open('https://www.youtube.com/results?search_query=' + movie_title + '+予告');
    return false;
  });
  
  // Amazonリンク
  $('.js-entry-link-amazon').on('click', function () {
    
    let movie_title = _movie_title.val();
    
    window.open('https://www.amazon.co.jp/s?k=' + movie_title + '&__mk_ja_JP=カタカナ&ref=nb_sb_noss_2');
    return false;
  });
  
  // Googleリンク
  $('.js-entry-link-google').on('click', function () {
    
    let movie_title = _movie_title.val();
    
    window.open('https://www.google.com/search?q=' + movie_title + '&hl=ja');
    return false;
  });
  
  // TMDbリンク
  $('.js-entry-link-tmdb').on('click', function () {
    
    let movie_title = _movie_title.val();
    
    window.open('https://www.themoviedb.org/search?language=ja&query=' + movie_title);
    return false;
  });

  
  // TMDb情報登録リンク
  $('.js-entry-tmdb').on('click', function () {
    let val_pid = $('input[name="post_id"]').val(),
        val_tid = $('input[name="tmdb_id"]').val();
    
    $('.js-entry-error-3').hide();

    if (isNumber(val_pid) && isNumber(val_tid)) {
      window.open('/api/?class=moviereview-tmdb&tid=' + val_tid + '&pid=' + val_pid);
    } else {
      $('.js-entry-error-3').html('レビューIDとTMDb IDが正しく入力されているか確認して、再度更新してください。').show();      
    }
    return false;
  });
});