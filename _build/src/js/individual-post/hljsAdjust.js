$(function(){
	$(".body .quote").addClass("hljs");
    
  // タブを半角2スペースに変換する
  $(".hljs").each(function(){

    let t = $(this).html();

    t = t.replace(/\t/g, "  ");
    $(this).html(t);
  });
});

/*
 * ATTENSION ライブラリhljs の処理で、pre内にある<br>タグをremoveするので、
 * 即時関数で、ライブラリが読み込まれる前に実行するように変更する
 */
(() => {
	$(".body pre").each(function(){
		let _this = $(this),
			text = "";
		if ($("code", _this).length == 0) {
			text = _this.html();
      text = getBrToNr(text);
			_this.html('<code class="hljs">' + text + '</code>');
		}
	});
  
  $('code').each(function () {
    let _this = $(this),
        text = _this.html();
    
    _this.html(getBrToNr(text));
  });
})();
