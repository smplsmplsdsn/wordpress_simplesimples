$(function () {
  
  const _star = $('.js-search-star'),
        _genre = $('.js-search-genre'),
        _runtime = $('.js-runtime'),
        _runtime_text = $('.js-runtime-text'),
        _release = $('.js-search-release'),
        _release_select = $('.js-search-release-select'),
        _country = $('.js-search-country');
  
  const _submit = $('.js-search-submit'),
        _form_condition = $('.js-form-condition'),
        _form_freeword_search = $('.js-form-freeword-search'),
        _search_clear = $('.js-search-clear');
  
  const y = (new Date()).getFullYear();
  
  const input_country = $('input[name="country"]', _form_condition),
        input_genre = $('input[name="genre"]', _form_condition),
        input_release = $('input[name="release"]', _form_condition),
        input_runtime = $('input[name="runtime"]', _form_condition),
        input_star = $('input[name="star"]', _form_condition),
        input_query = $('input[name="query"]', _form_freeword_search);
  
  let i = 0,
      html_star = '',
      html_release_year = '',
      clone_release_select;
  
  let star_link,
      genre_link = $('.js-search-genre a'),
      release_year_1,
      release_year_2;
  
  let runtiming;
  
  /**
   * 条件検索の条件をセットする
   */
  const setCondition = () => {
    
    let onstar = $('.on', _star),
        star_min = 10,
        star_max = 1,
        star_val = '',
        is_star;
    
    let ongenre = $('.on', _genre),
        genre_array = [],
        genre_val = '';
    
    let runtime_val = _runtime_text.val();
        
    let release_array = [],
        release_year_1_val = release_year_1.val(),
        release_year_2_val = release_year_2.val(),
        release_val = '';
    
    let country_val = _country.val();
    
    // 一旦リセットする
    input_star.val('');
    input_genre.val('');
    input_runtime.val('');
    input_release.val('');
    input_country.val('');
    
    /*
     * スター
     */
    onstar.each(function () {
      let v = $(this).attr('data-star');
      
      if (v != 'All') {
        is_star = true;
        star_min = Math.min(star_min, v);
        star_max = Math.max(star_max, v);
      }  
    });
    
    if (is_star) {
      star_val = (star_min == star_max)? star_min: star_min + ',' + star_max;
      input_star.val(star_val);
    }
    
    /*
     * ジャンル
     */
    ongenre.each(function () {
      genre_array.push($(this).attr('data-genre'));
    });
    
    if (genre_array.length > 0) {
      input_genre.val(genre_array.join(','));
    }
    
    /*
     * 上映時間
     */
    if (runtime_val != '') {
      input_runtime.val(runtime_val);        
    }
    
    /*
     * 公開年
     */
    if (release_year_1_val != 'all') {
      release_array.push(release_year_1_val);
    }

    if (release_year_2_val != 'all' && release_year_1_val != release_year_2_val) {
      release_array.push(release_year_2_val);
    }

    if (release_array.length > 0) {
      input_release.val(release_array.join(','));
    }
    
    /**
     * 制作国
     */
    if (country_val != 'all') {
      input_country.val(country_val);
    }
  }
  
  /**
   * 条件をクリアする
   */
  const clearForm = () => {
    input_star.val('');
    input_genre.val('');
    input_runtime.val('');
    input_release.val('');
    input_country.val('');

    star_link.removeClass('on');
    $('.on', _genre).removeClass('on');
    _runtime_text.val('');
    _runtime.val('');
    release_year_1.val('all');
    release_year_2.val('all');
    _country.val('all');
  }
  
  
  /*
   * 準備
   */

  // スター
  for (i = 0; i < 11; i++) {
    let v = (i === 10)? 'All': (i + 1);
    html_star += `
<a class="search__star-unit" data-star="${v}">
  <span class="search__star-star">★</span>
  <span class="search__star-num">${v}</span>
</a>
`;
  }
  _star.html(html_star);
  
  // 公開年
  for (i = y; i >= 1950; i--) {
    html_release_year += '<option value="' + i + '">' + i + '</option>';
  }
  _release_select.append(html_release_year).addClass('js-release-year-1');
  clone_release_select = _release_select.clone();
  clone_release_select.addClass('js-release-year-2').removeClass('js-release-year-1');
  _release.append(clone_release_select);
  
  release_year_1 = $('.js-release-year-1'),
  release_year_2 = $('.js-release-year-2');
  
  
  /*
   * アクション
   */
  
  // 検索する
  _submit.on('click', function () {
    $(this).closest('form').submit();  
    return false;
  });
  
  _form_condition.on('submit', function () {
    setCondition();
    getSearch('condition');
    return false;
  });
  
  _form_freeword_search.on('submit', function () {
    // clearForm();
    getSearch('freeword');
    return false;
  });
  
  // クリアする
  _search_clear.on('click', function () {
    let search_type = $(this).attr('data-type');
    
    if (search_type === 'freeword') {
      input_query.val('');          
    } else {
      clearForm();      
    }
    return false;
  });
  
  
  // スターを選択する
  star_link = $('a', _star);
  star_link.on('click', function () {
    let _this = $(this),
        star = _this.attr('data-star'),
        next_star = (+star) + 1,
        prev_star = (+star) - 1,
        min_star = star,
        max_star = star,
        i;
    
    // Allか判別する
    if (star === 'All') {
      star_link.removeClass('on');
      _this.addClass('on');
    } else {
      $('a[data-star="All"]').removeClass('on');
      
      // onの状態がある場合、最小値と最大値を取得する
      $('.on', _star).each(function () {
        let this_star = $(this).attr('data-star');
        
        min_star = (+Math.min(this_star, min_star));
        max_star = (+Math.max(this_star, max_star));
      });
      
      // 選択中か判別する
      if (_this.hasClass('on')) {
        
        // 最小値、もしくは最大値であれば、on削除し、
        // それ以外（真ん中）であれば、全on削除する
        if (star == min_star || star == max_star) {
          _this.removeClass('on');
        } else {
          star_link.removeClass('on');
        }
      } else {
        
        // 選択中が一つの場合は、その間もonにする
        if ($('.on', _star).length === 1) {
          for (i = min_star; i <= star; i++) {
            $('a[data-star="' + i + '"]').addClass('on');
          }
          for (i = star; i <= max_star; i++) {
            $('a[data-star="' + i + '"]').addClass('on');
          }            
        } else {
          
          // すでに選択中のとなりでない場合は全削除する
          if (!($('a[data-star="' + next_star + '"]').hasClass('on') || 
             $('a[data-star="' + prev_star + '"]').hasClass('on'))) {
            star_link.removeClass('on');
          }
          
          _this.addClass('on');
        }
      }
    }
  });
  
  // ジャンルを選択・解除する
  genre_link.on('click', function () {
    $(this).toggleClass('on');
    return false;
  });
  
  // 上映時間をセットする
  _runtime.on('input', function () {
    _runtime_text.val($(this).val());
  });
  
  _runtime_text.on('input', function () {
    let v = $(this).val();
    
    if (runtiming) clearTimeout(runtiming);
    runtiming = setTimeout(function () {
      _runtime.val(v);      
    }, 350);
  });
  
  // 公開年をセットする
  release_year_1.on('change', function () {
    let v1 = release_year_1.val(),
        v2 = release_year_2.val();
    
    if (v2 == 'all' || v1 > v2) {
      release_year_2.val(v1);
    }
  });
  
  release_year_2.on('change', function () {
    let v1 = release_year_1.val(),
        v2 = release_year_2.val();
    
    if (v1 == 'all' || v1 > v2) {
      release_year_1.val(v2);
    }
  })
  
});