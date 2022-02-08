/**
 * 詳細レビューを空にする
 */
const clearDetail = () => {
  const _detail_inner = $('.js-detail-inner');
  
  setTimeout(function () {
    _detail_inner.html('');
  }, 650);
}