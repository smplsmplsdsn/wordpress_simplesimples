/**
 * textareaの高さを自動調整
 * 参考: https://qiita.com/YoshiyukiKato/items/507b8022e6df5e996a59
 *
 * @param (object) tgt* 必須（なしの場合はエラー）textareaタグの指定 e.g. $('.js-textarea')
 * @param (number) font_size テキストエリア内のフォントサイズ
 * @param (number) line_height テキストエリア内の行間
 */
const autoAdjustTextareaHeight = (
  tgt, 
  font_size = 16,
  line_height = 1.6
) => {
  let h = Math.floor(font_size*line_height);

  tgt.css({
    'height': h,
    'padding': 0,
    'line-height': h + 'px',
    'font-size': font_size + 'px'
  }).on("input", function (e) {

    let _this = $(this),
        h_scroll = e.target.scrollHeight;

    if (h_scroll > e.target.offsetHeight) {  
      _this.height(h_scroll);
    } else {

      while (true) {
        _this.height(_this.height() - h); 
        if (e.target.scrollHeight > e.target.offsetHeight) {
          _this.height(e.target.scrollHeight);
          break;
        }
      }
    }
  });
  
  // すでにテキストエリアに文字列がある場合に備える
  tgt.height(tgt.get(0).scrollHeight);
}