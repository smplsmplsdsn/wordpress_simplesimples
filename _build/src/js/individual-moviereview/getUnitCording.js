/**
 * レビュー詳細のパーツごとhtml
 *
 * @param (object) info*
 * @return (object) マークアップ込みのデータ
 */
const getUnitCording = (info = {}) => {
  let obj = {},
      temp_array = [],
      temp_html = '';
  
  /**
   * 当時の年齢を取得する
   *
   * @param (string) date* 記事の投稿日
   * @return (string) 
   */
  const set_age_at_the_time = (date) => {
    let age_info = getAgeAtThatTime(date, '1975-07-09'),
        html_obj = {},
        html = '';
        
    if (!age_info.is_same) {
      html = `<span class="post__age">(当時${age_info.age}歳)</span>`;
    }
    
    return html;
  }
  
  // YouTube
  obj.youtube = (info.youtube != '')? `<div class="post__youtube-iframe">${info.youtube}</div>`: ``;  
  
  // タイトル
  temp_html = '';
  temp_html += `<h1 class="post__title">${info.title}`;  
  if (info.subtitle != '') {
    temp_html +=  `<span class="post__subtitle">${info.subtitle}</span>`;
  }
  temp_html +=  `</h1>`;  
  if (info.tmdb_original_title && (info.title != info.tmdb_original_title) && 
      (info.title + ' ' + info.subtitle != info.tmdb_original_title)) {
    temp_html +=  `<h2 class="post__original-title">${info.tmdb_original_title}</h2>`;
  }
  obj.title = temp_html;
  

  // 星、公開年、上映時間
  temp_html = '';
  temp_html +=  `<p class="post__spec">`;
  if (info.star && info.star != '' && info.star != '0') {
    temp_html +=  `<span class="post__spec-star">★${info.star}</span>`;      
  }
  if (info.tmdb_release && info.tmdb_release != '') {
    temp_html +=  `<span class="post__spec-year">${info.tmdb_release}</span>`;      
  }
  if (info.tmdb_runtime && info.tmdb_runtime != '' && info.tmdb_runtime != '0') {
    temp_html +=  `<span class="post__spec-runtime">${info.tmdb_runtime}分</span>`;      
  }
  temp_html +=  `</p>`;
  obj.spec = temp_html;

  // ジャンル
  if (Array.isArray(info.genre) && info.genre.length > 0) {
    temp_array = [];
    info.genre.forEach(v => {
      temp_array.push(v.name);
    });
    obj.genre =  `<p class="post__genre"><span class="post__genre">${temp_array.join('・')}</span></p>`;      
  } else {
    obj.genre = '';
  }

  // 制作国
  if (Array.isArray(info.country) && info.country.length > 0) {
    temp_array = [];
    info.country.forEach(v => {
      temp_array.push(v.name);
    });
    obj.country =  `<p class="post__country"><span class="post__country">${temp_array.join(', ')}</span></p>`;      
  } else {
    obj.country = '';
  }

  // 本文（感想）
  obj.content =  `<div class="post__content">${replaceJJ(info.content)}</div>`;

  // 公開日
  obj.date =  `
<p class="post__date">
  <span class="post__date-time">Review <time>${info.date}</time></span>
  ${set_age_at_the_time(info.date)}
</p>
`;
  
  // サムネイル
  if (info.tmdb_poster) {
    obj.poster_path = 'https://image.tmdb.org/t/p/w500' + info.tmdb_poster;
  } else if (info.amazon_poster) {
    obj.poster_path = info.amazon_poster;
  } else {
    obj.poster_path = '';    
  }
  obj.poster = `<figure class="post__figure" style="background-image: url(${obj.poster_path})"></figure>`;
  
  // TMDB タイトル
  temp_html = (info.tmdb_title != info.tmdb_original_title)? `<span class="post__tmdb-original-title">${info.tmdb_original_title}</span>`: '';
  obj.tmdb_title = `<h1 class="post__tmdb-title">${info.tmdb_title}${temp_html}</h1>`;
  
  // TMDB あらすじ
  obj.tmdb_overview = (info.tmdb_overview != '')? `
<dl class="post__tmdb-overview">
  <dt>あらすじ</dt>
  <dd>${info.tmdb_overview}</dd>
</dl>
`: ``;
    
  // TMDB 満足度
  if (info.tmdb_vote_count != '0') {
    obj.tmdb_star = `<p class="post__tmdb-star">TMDb ${info.tmdb_vote_average}/10 (${OBJ_NUMBER.format(info.tmdb_vote_count)})</p>`;    
  } else {
    obj.tmdb_star = '';
  }
  
  // TMDB 出演者
  temp_html = ``;
  if (Array.isArray(info.tmdb_cast) && info.tmdb_cast.length > 0) {
    temp_array = [];
    info.tmdb_cast.forEach(v => {
      let tmdb_profile = (v.profile)? `https://www.themoviedb.org/t/p/w276_and_h350_face${v.profile}`: ``;
      temp_html += `
<li>
  <a href="https://www.themoviedb.org/person/${v.id}" target="_blank">
    <figure class="post__tmdb-cast-figure" style="background-image: url(${tmdb_profile});"></figure>
    <span class="post__tmdb-cast-text">
      <span class="post__tmdb-cast-name">${replaceUTF(v.name)}</span>
      <span class="post__tmdb-cast-character">${replaceUTF(v.character)}</span>
    </span>
  </a>
</li>
`;
    });
  }
  obj.tmdb_cast = (temp_html != '')? `<ul class="post__tmdb-cast-list">${temp_html}</ul>`: ``;
  
  // TMDB 監督・脚本
  temp_html = ``;
  
  if (Array.isArray(info.tmdb_director) && info.tmdb_director.length > 0) {
    info.tmdb_director.forEach(v => {
      let tmdb_profile = (v.profile)? `https://www.themoviedb.org/t/p/w276_and_h350_face${v.profile}`: ``;
      temp_html += `
<li>
  <a href="https://www.themoviedb.org/person/${v.id}" target="_blank">
    <figure class="post__tmdb-list-figure" style="background-image: url(${tmdb_profile});"></figure>
    <span>
      <span class="post__tmdb-list-name">${replaceUTF(v.name)}</span><br>
      <span class="post__tmdb-list-staff">監督</span>
    </span>
  </a>
</li>
`;
    });
  }
  
  if (Array.isArray(info.tmdb_screenplay) && info.tmdb_screenplay.length > 0) {
    info.tmdb_screenplay.forEach(v => {
      let tmdb_profile = (v.profile)? `https://www.themoviedb.org/t/p/w276_and_h350_face${v.profile}`: ``;
      temp_html += `
<li>
  <a href="https://www.themoviedb.org/person/${v.id}" target="_blank">
    <figure class="post__tmdb-list-figure" style="background-image: url(${tmdb_profile});"></figure>
    <span>
      <span class="post__tmdb-list-name">${replaceUTF(v.name)}</span><br>
      <span class="post__tmdb-list-staff">脚本</span>
    </span>
  </a>
</li>
`;
    });
  }
  
  obj.tmdb_director_screenplay = (temp_html != '')? `<ul class="post__tmdb-list">${temp_html}</ul>`: ``;
  
  // Amazonリンク
  obj.amazon_link = (info.amazon_id != '')? `<a class="post__link post__link--amazon" href="https://www.amazon.co.jp/gp/offer-listing/${info.amazon_id}/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=${info.amazon_id}&linkCode=am2&tag=allinthemind-22" target="_blank">Amazon</a>`: ``;
  
  // TMDbリンク
  if (info.tmdb_type == '') {
    info.tmdb_type = 'movie';
  }
  obj.tmdb_link = (info.tmdb_id != '')? `<a class="post__link post__link--tmdb" href="https://www.themoviedb.org/${info.tmdb_type}/${info.tmdb_id}" target="_blank">TMDb</a>`: ``;
  
  return obj;
}
