/**
 *
 */
const cameraDataCording = (obj) => {
  const _d = $('.js-data');
  
  let h = '';
  
  h += `<section class="camera__unit js-camera-unit ${obj.ym}" data-search="${obj['13']}" data-model="${obj['2']}"><div class="camera__unit-inner">`;

  h += `
<p class="camera__release">${obj['4']}<span class="camera__s">発売</span></p>
<h1 class="camera__title">${obj['1']}</h1>
<p class="camera__model">${obj['2']}</p>
<p class="camera__sensor">${obj['10']}</p>
<p class="camera__price-first"><span class="camera__label">初値</span>${OBJ_NUMBER.format(obj['11'])}<span class="camera__s">円</span></p>
  `;
  
  if (obj['5'] != '' && obj['12'] != '0' && obj['11'] != obj['12']) {
    h += `
<p class="camera__price"><span class="camera__label">最安値</span>${OBJ_NUMBER.format(obj['5'])}<span class="camera__s">円</span></p>
<p class="camera__price-first-diff">${OBJ_NUMBER.format(obj['12']*(-1))}<span class="camera__s">円</span></p>
<p class="camera__price-date">${obj['6'].split(' ')[0]}</p>
    `;        
  }
  
  /*
  if (obj['7'] != '' && obj['9'] != '0' && obj['9'] != '') {
    h += `
<p class="camera__price-low">${OBJ_NUMBER.format(obj['7'])}<span class="camera__s">円</span></p>
<p class="camera__price-diff">${OBJ_NUMBER.format(obj['9']*(-1))}</p>
<p class="camera__price-low-date">${obj['8'].split(' ')[0]}</p>
    `;    
  }
  */
    
  h += `
<p class="camera__kakaku">
  <a class="camera__link" href="${obj['3']}" target="_blank">価格コム</a>
</p>
  `;
  h += `</div></section>`;
  
  _d.append(h);
}