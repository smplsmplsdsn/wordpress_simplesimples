/**
 * 画像先読み用のメソッド
 *
 * @param (image object) element: 画像オブジェクト
 * @param (handler) function: 画像読み込み成功時のメソッド
 * @param (errorHandler) function: 画像読み込み失敗時のメソッド
 */
const preloadImg = (element, handler, errorHandler = handler) => {
  
  if ("onreadystatechange" in element) {
    element.onreadystatechange = function (e) {
      if (element.readyState === "loaded" || element.readyState === "complete") {
        return handler(e);
      } else {
        return errorHandler(e);          
      }
    };
  } else {
    element.onload = handler;
    element.onerror = errorHandler;
  }  
}
