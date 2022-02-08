// URLからGETパラメータのキーと値をオブジェクトで取得する
const PARAM = getParam(location.search);

// ローカルストレージを取得する（オブジェクトを文字列で保存した値をオブジェクトに戻す。ない場合は空オブジェクト）
let LS = (typeof storageLS("ls") === "object")? storageLS("ls"): {};

// aタグと.js-linkには、.hoverをつける
setHover($('a, .js-link'));


// ストレージ値を反映する
$(function () {
  const _wrapper_inner = $('.js-wrapper-inner');
  
  // コンテンツ幅をセットする
  /*
  if (LS.range_post) {
    $('.js-range[data-name="post"]').val(LS.range_post);
    $('.js-wrapper-inner').width(LS.range_post);
  }
  */
  
  // カテゴリー、検索の場合、リスト数をカウントする
  if (_wrapper_inner.length > 0 && $('.list-unit', _wrapper_inner).length > 4) {
    _wrapper_inner.addClass('manylists');
  }
  _wrapper_inner.css({
    opacity: 1
  });
});
