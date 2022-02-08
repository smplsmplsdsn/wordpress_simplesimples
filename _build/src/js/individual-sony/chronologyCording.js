/**
 *
 */
const chronologyCording = (y, m, is_first) => {
  const _chronology = $('.js-chronology-inner');
  
  const attr_y = y,
        attr_m = (m < 10)? '0' + m: m,
        str_y = (is_first)? y: '';

  let t = `
<div class="chronology__unit js-chronology-unit" data-ym="ym${attr_y}${attr_m}">
  <div class="chronology__model js-series" data-series="a1"></div>
  <div class="chronology__model js-series" data-series="a9"></div>
  <div class="chronology__model js-series" data-series="a7s"></div>
  <div class="chronology__model js-series" data-series="a7r"></div>
  <div class="chronology__model js-series" data-series="a7"></div>
  <div class="chronology__model js-series" data-series="a"></div>
  <div class="chronology__model js-series" data-series="aps"></div>
  <div class="m">${m}</div>
  <div class="y">${str_y}</div>
</div>
  `;
  _chronology.append(t);
}