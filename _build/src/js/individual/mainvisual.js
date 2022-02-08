$(function () {
  const _mainvisual = $(".js-mainvisual");
  
  const changeMainvisual = () => {
    const tgt = $('.js-mainvisual-fig:first-child', _mainvisual);
    
    tgt.fadeOut(1000, function () {
      _mainvisual.append(tgt);
      tgt.show();
      setTimeout(changeMainvisual, 3500);
    });
    
  }
  
  if (_mainvisual.length > 0) {
    setTimeout(changeMainvisual, 3500);
  }  
});