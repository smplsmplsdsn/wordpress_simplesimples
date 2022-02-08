/**
 * 古い記事のレイアウト調整用
 */
$(function () {
  
  // amazon
  $(".content > iframe[src^='https://rcm-fe.amazon']").wrap('<aside class="amazon"></aside>');
  
  // info-seminar
  $('.info-seminar').removeAttr('style');
  
  // quote → hljs
  let is_quote = false;
  $(".quote").each(function () {
    let _this = $(this);
    
    switch (_this[0].tagName.toLowerCase()) {
      case 'blockquote':
      case 'section':
      case 'p':
        _this.addClass('blockquote');
        break;
        
      default:
        if ($('pre', this).length === 0 && $('code', this).length === 0) {
          _this.wrapInner('<pre><code class="hljs"></code></pre>');
          is_quote = true;
        } else if ($('pre', this).length > 0 && $('code', this).length === 0) {
          _this.wrapInner('<code class="hljs"></code>');
          is_quote = true;
        }        
    }
  });
  
  if (is_quote) {
    hljsAdjust();    
  }  
});