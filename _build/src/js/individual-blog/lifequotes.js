/**
 *
 */
const changeLifeqoutes = (_this) => {
  let exclusion_id = _this.attr('data-id');
  
  _this.off().html('<span class="animation-blinker">loading...</span>');
  lifequotes(exclusion_id);
}

const lifequotes = (exclusion_id = '') => {
  
  const _lifequotes = $('.js-lifequotes');
  
  let html = '',
      i;
  
  _lifequotes.stop().animate({
    opacity: 0
  });
  
  html = `
<p class="blog__lifequotes-info">読み込みに失敗しました</p>
<p class="blog__lifequotes-footer"><a class="js-link-lifequotes" data-id="${exclusion_id}">再読み込み</a></p>
  `;
  
  $.ajax({
    url: DOMAIN + '/api/?class=lifequotes&exclusion_id=' + exclusion_id,
    type: "GET",
    dataType: "json",
    timeout: 5000
  }).done(function (data) {
    
    if (Array.isArray(data)) {
      for (i in data) {
        let d = data[i];
        let info = (d.words_info)? '<span class="nowrap">(' + d.words_info + ')</span>': '';
        
        html = `
<p class="blog__lifequotes-text">${d.content}</p>
<p class="blog__lifequotes-info">${d.words_speaker}${info}</p>
<p class="blog__lifequotes-footer"><a class="js-link-lifequotes" data-id="${d.id}">CHANGE</a></p>
        `;
      }      
    }
  }).fail(function (e) {
  }).always(function () {
    _lifequotes.html(html).stop().animate({
      opacity: 1
    });
    $('.js-link-lifequotes').on('click', function () {
      changeLifeqoutes($(this));
      return false;
    });       
  });
}