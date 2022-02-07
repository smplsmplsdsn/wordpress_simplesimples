/**
 * 連想配列の指定キーの値が重複する場合は削除する
 * https://www.simplesimples.com/web/markup/javascript/配列の重複を削除する
 *
 * @param {array} ary* 配列
 * @param {string|null} key aryが連想配列の場合、重複判別するキー, 通常配列の場合は、null
 * @return {array} 処理後の配列
 */
const arrayDelDouble = (ary, key) => {
  let result,
      map,
      values;
  
  // MEMO: 処理件数による処理速度を考慮
  if (ary.length > 1000) {

    // 連想配列の場合
    if (typeof key === "string") {
      map = new Map(ary.map(o => [o[key], o]));
      result = Array.from(map.values());      
      
    } else {  // 配列の場合
      result = Array.from(new Set(ary));
    }
  } else {
    values = [];
    
    // 連想配列の場合
    if (typeof key === "string") {
      result = ary.filter(e => {
        if (values.indexOf(e[key]) === -1) {
          values.push(e[key]);
          return e;
        }
      });      
    } else {  // 配列の場合
      result = ary.filter(e => {
        if (values.indexOf(e) === -1) {
          values.push(e);
          return e;
        }
      });      
    }
  }
  return result;
}
