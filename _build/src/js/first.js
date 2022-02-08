/*
 * タッチデバイスか判別する
 */
const IS_TOUCH = (('ontouchstart' in window && 'ontouchend' in window) || navigator.msPointerEnabled || navigator.maxTouchPoints > 0)? true: false;

/*
 * iOSか判別する/Androidか判別する
 * https://qiita.com/kon_yu/items/f295033107089dd6468d
 * https://stackoverflow.com/questions/57765958/how-to-detect-ipad-and-ipad-os-version-in-ios-13-and-up/57924983#57924983
 */
const UA = navigator.userAgent;
const IS_IOS = (/iPad|iPhone|iPod/.test(UA)) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)? true: false;
const IS_ANDROID = (/android/i.test(UA))? true: false;

/*
 * 数字を３桁ごとにカンマを入れる
 * e.g., OBJ_NUMBER.format(3500) -> 3,500
 */
const OBJ_NUMBER = new Intl.NumberFormat('en-US', {style: 'decimal'});

/*
 * リサイズがとまったときのイベントを追加する（変数重複にケアして、即時間数で対応）
 * e.g., $(window).on("resizestop", function(){});
 *
 */
(() => {
  let stopEvent = new $.Event("resizestop"),
      timer;
 
  let stopEventTrigger = () => {
    if (timer) clearTimeout(timer);
    timer = setTimeout(function(){$(window).trigger(stopEvent)}, 300);
  }
  $(window).on("resize", stopEventTrigger);
})();

/*
 * スクロールがとまったときのイベントを追加する（変数重複にケアして、即時間数で対応）
 * http://www.risewill.co.jp/blog/archives/2618
 *
 * e.g., $(window).on("scrollstop", function(){}); 
 */
(() => {
  let stopEvent = new $.Event("scrollstop"),
      timer;
 
  let stopEventTrigger = () => {
    if (timer) clearTimeout(timer);
    timer = setTimeout(function(){$(window).trigger(stopEvent)}, 100);
  }
  $(window).on("scroll", stopEventTrigger);
})();
 

/**
 * ダブルタップを無効にする（タッチデバイスの場合）
 *
 * @param {object} tgt jQueryでの指定要素
 */
const stopDblClick = function(tgt){
  if (IS_TOUCH) {
    tgt.on("touchend", function(e){
      e.preventDefault();
    });
  }
}

/**
 * スクロールを無効にする（タッチデバイスの場合）
 *
 * @param {object} tgt jQueryでの指定要素
 */
const stopScroll = function(tgt){
  if (IS_TOUCH) {
    tgt.on("touchmove", function(e){
      e.preventDefault();
    });
  }
}

/**
 * ダブルクリックとスクロール処理を無効にする（タッチデバイスの場合）
 *
 * @param {object} tgt jQueryでの指定要素
 */
const stopDblClickAndScroll = function(tgt){
  if (IS_TOUCH) {
    tgt
    .on("touchmove", function(e){
      e.preventDefault();
    })
    .on("touchend", function(e){
      e.preventDefault();
    });  
  }
}

const eventstart = (IS_TOUCH)? 'touchstart': 'mousedown';
const eventmove = (IS_TOUCH)? 'touchmove': 'mousemove';
const eventend = (IS_TOUCH)? 'touchend': 'mouseup';
const eventover = (IS_TOUCH)? 'touchstart': 'mouseover';
const eventout = (IS_TOUCH)? 'touchmove': 'mouseout';


/**
 * タップ（タッチデバイスでの反応速度を上げるための対応）
 * TODO 今どきのスマホでも、処理速度に違いがあるか検証する
 * BUG Androidでposition: fixed の中のリンクのときに、反応が悪い
 *
 * @param {object} tgt jQueryでの指定要素
 * @param {function} func タップ時の処理（タップ要素を返却） 
 */
const tap = function (tgt, func){
  let IS_CLICK = false;
  
  tgt
  .on(eventstart, function () {
    IS_CLICK = true;
    
    // 長押し離しは無効になるようにケア
    setTimeout(function(){
      IS_CLICK = false;
    }, 300);
    return false;
  })
  .on(eventmove, function () {
    IS_CLICK = false;
    return false;
  })
  .on(eventend, function () {    
    if (func && (IS_CLICK || !IS_TOUCH)) func($(this));
    return false;
  }); 
}


/**
 * ロングタップ（シングルタップ）
 * TODO 今どきのスマホでも機能するか検証する
 * BUG Androidでposition: fixed の中のリンクのときに、反応が悪い
 */
const longtap = function (tgt, func_long, func_single) {
  let LONGTAPPING;
  let IS_CLICK = false;
  
  tgt
  .on(eventstart, function () {
    IS_CLICK = true;
    
    // 長押し離しか判別する
    if (LONGTAPPING) clearTimeout(LONGTAPPING);
    LONGTAPPING = setTimeout(function(){
      if (func_long && IS_CLICK) {
        func_long($(this));
      }
      IS_CLICK = false;
    }, 300);
    return false;
  })
  .on(eventend, function () {    
    if (func_single && IS_CLICK) {
      func_single($(this));
      IS_CLICK = false;
    };
    return false;
  }); 
}


/**
 * ダブルタップ（シングルタップ）
 * TODO 今どきのスマホでも機能するか検証する
 * BUG Androidでposition: fixed の中のリンクのときに、反応が悪い
 */
const dbltap = function (tgt, func_double, func_single) {
  let TAP_COUNT = 0;
  let IS_CLICK = false;
  let IS_DBLCLICK = false;
  
  tgt
  .on(eventstart, function () {
    IS_CLICK = true;
    TAP_COUNT++;
        
    if (TAP_COUNT == 2) {
      IS_DBLCLICK = true;
      TAP_COUNT = 0;
    }
    
    // ダブルタップ判定解除して、シングルタップが有効か判別する
    setTimeout(function(){
      TAP_COUNT = 0;
      IS_DBLCLICK = false;
      if (func_single && IS_CLICK) {
        func_single($(this));
      }
      IS_CLICK = false;
    }, 300);
    
    return false;
  })
  .on(eventend, function(e) {
    
    if (func_double && IS_DBLCLICK) {
      e.preventDefault();
      func_double($(this));
      IS_DBLCLICK = false;
      IS_CLICK = false;
    }
    return false;
  }); 
}




