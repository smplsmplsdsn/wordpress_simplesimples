/**
 * 数字だけの値か判別する
 * (MEMO) Number.isInteger: 値が整数か判別する（IEは未対応）もある
 *
 * @param {string|number}
 * @return boolean
 */
const isNumber = (v) => {  
  let pattern = /^[0-9]+$/;
  return pattern.test(v);
}