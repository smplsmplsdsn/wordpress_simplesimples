/**
 * 
 */
const linkWorks = () => {
    
  $('.js-link-works')
  .each(function () {
    let _this = $(this),
        bg = _this.attr('data-image'),
        img = new Image();
    
    // 画像の読み込み
    img.src = bg;    
    preloadImg(img, function () {
      _this.css({
        'background-image': 'url(' + img.src + ')'
      }).removeAttr('data-image');
    });
  })
  .on('mouseleave', function () {
    $(this).removeClass('selected');
  })
  .on('click', function () {
    let _this = $(this),
        num = _this.attr('data-num');
    
    _this.addClass('selected');
    
    viewWorks(num);
    return false;
  });
}