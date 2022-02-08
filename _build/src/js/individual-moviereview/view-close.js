$(function () {
  
  $('.js-detail-close').on('click', function () {
    viewPause('detailing');
    clearDetail();
    
    // history API
    historyPushState({}, '', '/moviereview/');      

    return false;
  });
  
  $('.js-search-close').on('click', function () {
    SEARCHING = false;
    viewPause('searching');
    
    return false;
  });
  
});