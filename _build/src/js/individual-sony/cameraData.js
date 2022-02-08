/**
 *
 */
const cameraData = () => {
  let INIT_HTML = '',
      i;
    
  $.ajax({
    url: JSON_FILE,
    type: "GET",
    dataType: "json",
    timeout: 5000
  }).done(function (data) {
    
    let ymd = '',
        y = '',
        m = '',
        d = '',
        ary_ymd = [];
    
    JSON_DATA = data;
    
    if (Array.isArray(JSON_DATA)) {
        
      // 検索用の調整
      for (i in JSON_DATA) {
        ymd = JSON_DATA[i]['4'];
        ary_ymd = ymd.split('-');
        y = ary_ymd[0];
        m = ary_ymd[1];
        d = ary_ymd[2];
        
        y = y.trim();
        m = m.trim();
        d = d.trim();

        if (m < 10) m = '0' + m;
        if (d < 10) d = '0' + d;
        
        JSON_DATA[i]['4-2'] = new Date(y + '-' + m + '-' + d).getTime();
        JSON_DATA[i].ym = 'ym' + y + m;

        SEARCH_ARY.push(JSON_DATA[i]['13']);      
      }

      SEARCH_ARY = arrayDelDouble(SEARCH_ARY);

      // 名前順に並び替え
      JSON_DATA = arraySort(JSON_DATA, '2');

      // 発売日の古い順に並び替え
      JSON_DATA = arraySort(JSON_DATA, '4-2');

      for (i in JSON_DATA) {
        cameraDataCording(JSON_DATA[i]);
      }

      setChronology();
      moveScroll();
    }
    
    
  }).fail(function (e) {
    
  }).always(function () {
        
  });
}


