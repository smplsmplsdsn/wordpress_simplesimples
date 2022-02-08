/**
 *
 */
const twitter = () => {
  const _twitter = $('.js-twitter');
  
  let html = '',
      i;
    
  $.ajax({
    url: DOMAIN + '/api/?class=twitter',
    type: "GET",
    dataType: "json",
    timeout: 5000
  }).done(function (data) {
    
    html += '<ul>';
    if (Array.isArray(data)) {
      for (i in data) {
        let d = data[i];
        html += `
<li class="${d.user.toLowerCase()}">
  <span class="twitter__screenname"><a class="${d.user.toLowerCase()}" href="https://twitter.com/${d.user}" target="_blank">@${d.user}</a></span>
  <p class="twitter__text">${getUrlToLink(d.text, 'blank')}</p>
  <time class="twitter__createdat">${d.created_at}</time>
</li>
        `;        
      }
    }
    html += '</ul>';
    
    _twitter.html(html);
  }).fail(function (e) {
    _twitter.html('<span class="twitter__error">読み込みに失敗しました</span>');
  }).always(function () {
        
  });
}
