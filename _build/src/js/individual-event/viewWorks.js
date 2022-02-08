/**
 * 実績を表示する
 *
 * @param (string|number) num: 配列の順番
 */
const viewWorks = (num) => {
  const _works = $('.js-works'),
        _works_view = $('.js-works-view'),
        _link_works =$('.js-link-works');
  
  let obj = MEMBERS_SHUFFLE[num],
      insta = (obj.insta)? '<a href="https://www.instagram.com/' + obj.insta + '/" target="_blank">Insta</a>': '';
  
  // worksを表示する(回転して非表示にする)
  _works.addClass('show');
  
  // worksのデータを上書きする  
  _works_view.html(`
<img class="works__image" src="${ASSETS_PATH}/images/event/otonanoaoharuten/works/works-${obj.image}">
<div class="works__info">
  <figure style="background-image:url(${ASSETS_PATH}/images/event/otonanoaoharuten/icon/icon-${obj.icon});"></figure>
  <p>${obj.name}</p>
  ${insta}
</div>

  `);
  
  // タイムラグを作る
  setTimeout(function () {

    // worksを回転して表示する
    _works.addClass('rotate');
    
    // 
    _link_works.removeClass('selected');
  }, 200);
  
  $('.js-works-close').on('click', function () {
    _works.removeClass('rotate');
    setTimeout(function () {
      _works.removeClass('show');
    }, 500);
    return false;
  });
}