/**
 * PC閲覧時のコンテンツ幅を変更する
 * レンジを動かした後に、その値をローカルストレージに保存する
 * e.g., <input type="range" class="js-range" min="0" max="100" value="50" data-name="range-name"> 
 */
$(function () {
  
  const _range = $('.js-range');  
  let timer;
  
  const _wrapper = $('.js-wrapper-inner');
  
  _range.on('input', function () {
    let _this = $(this),
        val = _this.val(),
        n = _this.attr('data-name');
    
    
    // ローカルストレージに保存する
    if (timer) clearTimeout(timer);
    timer = setTimeout(function (){
      LS['range_' + n] = val;
      storageLS("ls", LS);
    }, 600);
    
    // サービスごとに異なる処理
    switch (true) {
      case n === 'post':
        _wrapper.width(val);
        break;
      
      // defaultなし
    }
  });
});
