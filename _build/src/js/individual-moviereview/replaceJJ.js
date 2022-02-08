/**
 * 本文の文字列置換（リニューアル前の名残り）
 */
const replaceJJ = (s = '') => {
  let str = s;
  
  str = str.replace(/＜jj:or＞/g, " or ");
  str = str.replace(/＜jj:and＞/g, " and ");
  str = str.replace(/＜jj:rn＞/g, "<br>");
  str = str.replace(/＜jj:b＞/g, "<strong>");
  str = str.replace(/＜\/jj:b＞/g, "</strong>");
  return str;
}