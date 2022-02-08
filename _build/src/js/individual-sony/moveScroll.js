/**
 *
 */
const moveScroll = () => {
  let _camera_unit = $('.js-camera-unit'),
      w_camera_unit = _camera_unit.outerWidth(),
      _chronology_unit = $('.js-chronology-unit'),
      w_chronology_unit = _chronology_unit.outerWidth();
  
  $('.js-camera').scrollLeft(w_camera_unit*_camera_unit.length);
  $('.js-chronology').scrollLeft(w_chronology_unit*_chronology_unit.length + 100);
  
  $('.js-loading').remove();
}
