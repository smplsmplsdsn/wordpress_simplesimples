/**
 * 検索条件と検索結果数をマークアップ
 *
 * @param (string) search_type* 検索タイプ（フリーワードか条件か）
 * @param (array) form_data* 検索パラメータ
 */
const setConditionCording = (search_type, form_data) => {
  let total_num = ($('.js-total-num').length > 0)? $('.js-total-num').text(): '';
  
  let obj = {},
      h = '',
      tmp = '',
      tmp_array = [],
      tmp_array_2 = [],
      param_array = [],
      param_query,
      param_country,
      param_genre,
      param_release,
      param_runtime,
      param_star,
      i;
    
  let review_unit = '';

  // 配列をオブジェクトに変更する
  // https://chaika.hatenablog.com/entry/2019/05/07/083000
  form_data.forEach((data, i) => {
    obj[data.name] = data;
  });
  
  // 検索タイプ別に文言を変更する
  if (search_type === 'freeword') {
    if (obj.query && obj.query.value.trim() != '') {
      h += `フリーワード「${obj.query.value}」の検索結果`;        
    }
  } else {
    if (obj.star && obj.star.value != '') {
      tmp = '★' + obj.star.value.replace(/,/g, '〜');
      param_array.push(tmp);
    }
    if (obj.genre && obj.genre.value != '') {
      tmp_array = [];
      tmp_array_2 = [];
      tmp_array = obj.genre.value.split(',');
      for (i in tmp_array) {
        tmp = $('.js-genre[data-genre="' + tmp_array[i] + '"]').text();
        tmp_array_2.push(tmp);
      }
      param_array.push(tmp_array_2.join('・'));
    }
    if (obj.runtime && obj.runtime.value != '') {
      tmp = obj.runtime.value + '分以下';
      param_array.push(tmp);
    }
    if (obj.release && obj.release.value != '') {
      tmp = obj.release.value.replace(/,/, '〜') + '年公開(配信)';
      param_array.push(tmp);
    }
    if (obj.country && obj.country.value != '') {
      tmp = $('.js-country[value="' + obj.country.value + '"]').text();
      tmp = '制作国：' + tmp;
      param_array.push(tmp);
    }
    
    if (param_array.length > 0) {
      h += `「${param_array.join('、')}」`;
      if (total_num != '') {
        review_unit = (total_num === "1")? 'review': 'reviews'
        h += `<span class="nowrap">の検索結果 (${total_num} ${review_unit})</span>`;
      }
    }
  }
  
  if (h === '') {
    h = 'すべてのレビュー';
  }
  
  return h;
}