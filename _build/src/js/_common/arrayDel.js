/**
 * 配列から指定値を削除する
 *
 * @param {array} ary*: 対象の配列
 * @param {array} del_array*: 削除したい値の配列（複数指定することが可能）
 * @return {array} 削除後の配列
 */
const arrayDel = (ary, del_ary) => {
  return ary.filter(function (v) {
    return !del_ary.includes(v);
  });
}
