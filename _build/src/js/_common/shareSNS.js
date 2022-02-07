/**
 * SNSの共有リンクを取得する
 *
 * @param {string} url* 共有用リンク
 * @param {string} title 共有用タイトル
 * @return {object} 各SNSのリンク
 */
const shareSNS = (url, title = "") => {
  return {
    twitter: 'https://twitter.com/share?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title),
    facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url),
    line: 'https://line.me/R/msg/text/?' + encodeURIComponent(title) + ' ' + url  // lineのurlはエンコード不要 
  }
}

