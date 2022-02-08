$(function () {
  let count = MEMBERS_SHUFFLE.length,
      h = '',
      i,
      j = 0;
  
  /**
   * 画像読み込み後のマークアップ
   */  
  for (i in MEMBERS_SHUFFLE) {
    let m = MEMBERS_SHUFFLE[i],
        bg = ASSETS_PATH + '/images/event/otonanoaoharuten/works/works-' + m.image;
        
    // コーディング
    if (j === 6) {
      h += `<li></li>`;
    }
    h += `<li><a class="js-link-works" data-num="${j}" data-image="${bg}"></a></li>`;
    j++;
  }
  
  $('.js-members-works').html(h);
  linkWorks();
});
