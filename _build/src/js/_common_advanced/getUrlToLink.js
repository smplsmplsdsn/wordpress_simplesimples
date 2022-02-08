/**
 * 文字列内のURLを外部リンクにする
 * https://qiita.com/nyankote/items/b39c92573c119b2776ac
 *
 * 画像のsrcやcssのhrefは対象外にしようとすると、Safari で構文エラー
 * const exp = /((?<!href="|href='|src="|src=')(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
 *
 * @param (string) string: 対象文字列
 * @param (string|null) state: "blank"|"none"|null
 * @return (string)
 */
const getUrlToLink = (string = '', state) => {
  const exp = /((https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
  
  let s = '';
  
  switch (state) {
    case 'none':
      s = string.replace(exp, '');
    case 'blank':
      s = string.replace(exp, '<a href="$1" target="_blank">$1</a>');
      break;
    default:
      s = string.replace(exp, '<a href="$1">$1</a>');
  }
  
  return s;
}
