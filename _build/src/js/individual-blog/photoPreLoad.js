/**
 * 画像を画面表示前に読み込む
 */
const photoPreLoad = () => {
  const _img = $('.js-content img'),
        _loading_bar = $('.js-photo-bar'),
        h_header = $('.js-header').outerHeight(),
        count = _img.length;
  
  let i = 0;  
  
  _img.each(function (n) {
    let _this = $(this),
        path = _this.attr('src'),
        img = new Image();
    
    _this.addClass('js-slide-link').attr('data-nav', n + 1).css({cursor: 'pointer'});
    
    img.src = path;
    preloadImg(img, () => {
      i++;
      
      _loading_bar.width((i/count)*100 + '%');
      
      if (i == count) {
        setTimeout(function () {
          $('.js-photo-splash').fadeOut(function(){
            $(this).remove();
            if (window.pageYOffset < h_header) {
              pageScroll(h_header);              
            }
          });          
          photoInit();
        }, 350);
        
        
        
        
      }
    });
    
  });
}