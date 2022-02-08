/**
 * レビュー詳細を表示する
 * NOTICE 事前に、DOMAIN を呼び出しておく必要あり
 *
 * @param (string|number) post_id 投稿ID、指定ない場合はエラー画面を表示する
 */
const setUnitCording = (post_id) => {
  const _title = $('title'),
        _detail_inner = $('.js-detail-inner'),
        info = MOVIE_INFO[post_id];
  
  let text_title = '',
      html = '',
      html_obj = {},
      url = DOMAIN + '/moviereview/?movie_id=' + post_id;
  
  let i;


  
  if (post_id != '' && (typeof info === 'object') && info.title) {
    text_title = info.title + ' | たけたけの映画レビュー';
    
    html_obj = getUnitCording(info);
    /*
  html_obj.poster_path
  html_obj.id
  html_obj.update
    */
    

    html = `
<div class="post__youtube">
  ${html_obj.youtube}
  <div class="post__youtube-bg" style="background-image: url(${html_obj.poster_path});"></div>
</div>
<div class="post__main">
  <div class="post__header">
    ${html_obj.title}
    ${html_obj.spec}
    ${html_obj.genre}
    ${html_obj.country}
  </div>
  ${html_obj.content}
  ${html_obj.date}
  ${html_obj.poster}
  <div class="post__links">
    ${html_obj.amazon_link}
    ${html_obj.tmdb_link}
  </div>
</div>
<div class="post__tmdb">
  <div class="post__tmdb-inner">
    <div class="post__tmdb-header">
      <div class="post__tmdb-text">
        ${html_obj.tmdb_title}
        ${html_obj.tmdb_star}
        ${html_obj.tmdb_director_screenplay}
      </div>
      <div class="post__tmdb-poster">
        <figure class="post__tmdb-figure" style="background-image: url(${html_obj.poster_path});"></figure>
      </div>
    </div>
    ${html_obj.tmdb_overview}
    <div class="post__tmdb-cast">
      ${html_obj.tmdb_cast}
    </div>
  </div>
</div>
`;
        
  } else {
    text_title = '映画レビューが見つかりませんでした | たけたけの映画レビュー';
    html = '';
  }
  
  /*
   * head情報を置き換える
   * ATTENSION マークアップ後である必要あり
   */
  _title.text(text_title);
  $('link[rel="canonical"]').attr('href', url);
  $('meta[name="description"]').attr('content', '');
  
  /*
  _detail_inner.css({opacity: 0}).html(html);
  _detail_inner.animate({
    opacity: 1
  }, 1000);
  */
  _detail_inner.html(html);
  
  // aタグと.js-linkには、.hoverをつける
  setHover($('a', _detail_inner));
}

