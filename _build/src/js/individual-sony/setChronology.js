/**
 *
 */
const setChronology = () => {
  const _camera = $('.js-camera'),
        _camera_unit = $('.js-camera-unit'),
        w_camera_unit = _camera_unit.outerWidth();
  
  let i;

  for (i in JSON_DATA) {
    let ym = JSON_DATA[i].ym,
        name = JSON_DATA[i]['1'],
        model = JSON_DATA[i]['2'],
        search = JSON_DATA[i]['13'];
    
    $('.js-chronology-unit[data-ym="' + ym + '"] .js-series[data-series="' + search + '"]').append('<a class="js-link-model" data-model="' + model + '">' + name + '</a>');
  }
  
  $('.js-link-model').on('click', function () {    
    let model = $(this).attr('data-model'),
        tgt = $('.js-camera-unit[data-model="' + model + '"]'),
        pos = _camera.scrollLeft(),
        diff = pos + tgt.offset().left - window.innerWidth/2 + w_camera_unit/2;
    
    _camera_unit.removeClass('selected');
    tgt.addClass('selected');
    
    _camera.animate({
      scrollLeft: diff
    });
    
    
    return false;
  });
}