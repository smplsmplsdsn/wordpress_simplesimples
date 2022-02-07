/**
 * 連想配列の並び替え
 * simplesimples.com/web/markup/javascript/sort_array_object/
 *
 * @param {array} ary* 並び替えたい配列
 * @param {string} ky* 並び替えの対象とするキー
 * @param {boolean} st 並び順 true: 降順, false: 昇順
 * @return {array} 並び替え後の配列
 */
const arraySort = (ary = [], ky = '', st = false) => {
  let ary_ky = ('string' == typeof ky || 'number' == typeof ky)? new Array(ky): ky,
      ary_ky_num = ary_ky.length,
      ary_st = [],
      key = null,
      srt = null;

  // 並び替え（降順かどうか）
  if ('boolean' == typeof st && st === true) {
    ary_st.push(st);
  } else if (st) {
    ary_st = st;
  }
  
  ary.sort(function(a, b) {
    function ary_chk(i) {
      key = ary_ky[i];
      srt = (ary_st[i])? -1: 1;

      if (a[key] < b[key]) {
        return -1 * srt;
      } else if (a[key] > b[key]) {
        return 1 * srt;
      } else {
        if (i < ary_ky_num) {
          return ary_chk(i+1);
        } else {
          return 0;
        }
      }
    }
    return ary_chk(0);
  });
  
  return ary;
}
