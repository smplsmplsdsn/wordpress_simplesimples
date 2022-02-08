// URLからGETパラメータのキーと値をオブジェクトで取得する
const PARAM = getParam(location.search);

// ローカルストレージを取得する（オブジェクトを文字列で保存した値をオブジェクトに戻す。ない場合は空オブジェクト）
let LS = (typeof storageLS("ls") === "object")? storageLS("ls"): {};

// aタグと.js-linkには、.hoverをつける
setHover($('a, .js-link'));

// フッターナビをスクロール状態で表示・非表示を出し分ける
$(function () {
  if ($('.js-nav').length > 0 && $('.js-footer').length > 0) {
    nav();
  }
});
