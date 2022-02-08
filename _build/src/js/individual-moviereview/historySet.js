/*
 * history API（戻る、進むをクリックした際の挙動）
 * MEMO リストをリンクしたとき、検索したとき
 */
historySet(function (d) {
  if (d && d.post_id) {
    setUnit(d.post_id);      
  } else {
    viewPause('detailing');
    clearDetail();
  }
});