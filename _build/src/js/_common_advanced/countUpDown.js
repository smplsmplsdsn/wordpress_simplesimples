/**
 * カウントアップ/カウントダウン
 * (MEMO) Number.isInteger: 値が整数か判別する（IEは未対応）
 *
 * @param {object} *tgt: 要素
 * @param {number} *st: スタートの数字（整数のみ）
 * @param {number} *ed: エンドの数字（整数のみ）
 * @param {number|function|object} param:
 *  {number} カウントアップのスピード（ミリ秒、デフォルト1秒、整数のみ）
 *  {function} カウント終了時に実行する関数
 *  {object}
 *    {number} speed: カウントアップのスピード（ミリ秒、デフォルト1秒）
 *    {number} unit: カウントアップする量（デフォルト1、整数のみ）
 *    {function} func: カウント終了時に実行する関数
 *    {boolean} is_not_click: カウント表示領域をクリックしてカウント終了できるようにするかどうか（デフォルトfalse）
 *
 * @return なし
 */
const countUpDown = (tgt, st, ed = 0, param) => {
  
  const countupdown_number = new Intl.NumberFormat('en-US', {style: 'decimal'});

  /**
   * カウントした値の表示
   */
  const countingUpDown = () => {
    
    tgt.html(countupdown_number.format(n));
    
    
    // カウント終了か判別する
    if ((is_up && ed <= n) || (!is_up && ed >= n)) {
      
      // カウントオーバーした場合に備えて上書きする
      n = ed;
      tgt.html(countupdown_number.format(n));
      
      if (func) func();
    } else {
      
      // 次のカウントを実行する
      n = (is_up)? n + unit: n - unit;
      if (anime_count) clearTimeout(anime_count);
      anime_count = setTimeout(countingUpDown, speed);
    }
  }  
  
  // 値を設定する
  let n = st,
      speed = 1000,
      unit = 1,   // カウントアップ・ダウンする量
      func = null,
      anime_count = null,
      is_not_click = false,
      is_up;
  
  switch (true) {
    case Number.isInteger(param):
      speed = param;
      break;
    case typeof param == "function":
      func = param;
      break;
    case typeof param == "object":
      if (Number.isInteger(param["speed"])) {
        speed = param["speed"];    
      }
      if (Number.isInteger(param["unit"])) {
        unit = param["unit"];    
      }
      if (typeof param["func"] == "function") {
        func = param["func"];    
      }
      is_not_click = param["is_not_click"];
      break;
      
    // default: なし
  }
  
  // 要素があるか判別する
  if (tgt && tgt.length > 0) {
    
    // st, ed, speed が整数か判別する
    if (Number.isInteger(st) && Number.isInteger(ed) && Number.isInteger(speed)) {

      // カウントアップかダウンか判別する
      is_up = (ed - st > 0)? true: false;

      // カウントする
      countingUpDown();   
    } else {

      // 最後の値に差し替える
      tgt.html(countupdown_number.format(ed));
      if (func) func();
    }

    // 要素をクリックしたら、エンドの数字をセットする
    if (!is_not_click) {
      tgt.css({cursor: "pointer"}).on("click", function(){
        n = ed;
        countingUpDown();
        return false;
      });      
    }
  }
}



