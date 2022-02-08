// URLからGETパラメータのキーと値をオブジェクトで取得する
const PARAM = getParam(location.search);

// ローカルストレージを取得する（オブジェクトを文字列で保存した値をオブジェクトに戻す。ない場合は空オブジェクト）
let LS = (typeof storageLS("ls") === "object")? storageLS("ls"): {};

const MOVIE_INFO = {};

$(function () {
  
  // iOSスクロールバグ
  bugfixScroll($('.js-detail'));
  
  // aタグと.js-linkには、.hoverをつける
  setHover($('a, .js-link'));

  // レビュー詳細指定がある場合
  if (PARAM.movie_id) {
    setUnit(PARAM.movie_id);
  }

  // リスト表示後
  setList();
});
