$(function () {
  let h = '',
      i;
  
  for (i in MEMBERS_SHUFFLE) {
    let m = MEMBERS_SHUFFLE[i],
        insta = (m.insta)? '<a href="https://www.instagram.com/' + m.insta + '/" target="_blank">Insta</a>': '';
    
    h += `
<li>
  <figure style="background-image: url(${ASSETS_PATH}/images/event/otonanoaoharuten/icon/icon-${m.icon})"></figure>
  <span class="name">${m.name}</span>
  ${insta}
</li>
    `;    
  }
  
  $('.js-members-list').html(h);
});



