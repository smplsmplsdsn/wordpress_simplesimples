/**
 *
 */
$('[name="series"]').on('change', function () {
  const _camera_unit = $('.js-camera-unit'),
        w_camera_unit = _camera_unit.outerWidth(),
        _data = $('.js-data'),
        _series = $('.js-series');
  
  let w = window.innerWidth;
  
  let v = $('[name="series"]:checked').map(function(){return $(this).val();}).get(),
      i;
  
  // 一旦非表示にする
  _camera_unit.hide().removeClass('show');
  _series.removeClass('selected').addClass('off');
  
  // 表示位置をリセットする
  _data.removeClass('center');
  
  if (v.length > 0 && v[0] != 'all') {
    
    if (v[0] === 'a7all') {
      v = ['a7', 'a7s', 'a7r'];
    }
    
    for (i in v) {
      $('.js-camera-unit[data-search="' + v[i] + '"]').show().addClass('show');
      $('.js-series[data-series="' + v[i] + '"]').addClass('selected').removeClass('off');
    }
  } else {
    _camera_unit.show().addClass('show');
    _series.removeClass('off');
  }
  
  if (w_camera_unit*$('.js-camera-unit.show').length < w) {
    _data.addClass('center');
  } else {
    _data.removeClass('center');
  }

});