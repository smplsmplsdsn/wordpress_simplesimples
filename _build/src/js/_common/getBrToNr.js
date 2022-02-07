/**
 * <br>を改行コードに変換する
 * textareaの値にセットする際に使う
 * PHP htmlspecialcharsで処理されたケースも想定する
 *
 * @param {string} str*
 * @return {string} 変換後のstr
 */
const getBrToNr = (str = '') => {
  str = str.replace(/(<br>|<br \/>)/gi, '\n');
  return str;
};
