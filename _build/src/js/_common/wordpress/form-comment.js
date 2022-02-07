/**
 * 記事コメント
 */
$(function () {
	let _tgt = $(".js-form-comment"),
      comment = $("[name=comment]", _tgt),
      nickname = $("[name=author]", _tgt),
      message = $(".js-comment-message", _tgt),
      submit_btn = $(".js-comment-submit", _tgt),
      submit_text = submit_btn.attr("value"),
      submit_size = submit_btn.width(),
      message_none = $(".js-comment-none"),
      is_commenting;
	
	submit_btn.width(submit_size);
	
	if (message_none.length > 0) {
		$(".js-comment__description").after(message_none);
	}

	_tgt.on("submit", function(){
		message.html("").hide().removeClass("comment__message--success").removeClass("comment__message--alert");

		if ("" == comment.val().trim()) {
			message.html("コメント送信できませんでした。恐れ入りますが、コメントが入力されていることをご確認の上、もう一度お試しください。").addClass("comment__message--alert").show();
		} else {
			if (!is_commenting) {
				is_commenting = true;
				
				submit_btn.attr("value", "送信中").addClass("animation-blinker");
				
				$.ajax({
					type: 'POST',
					url: $(this).data('action'),
					data: $(this).serializeArray(),
					dataType: 'html'
				})
				.done(function(){
					var t = '';
					t += '<div class="comment__unit-outer">';
					t += '<div class="comment__unit">';
					t += getNrToBr(comment.val());
					t += '<div class="comment__unit-info">';
					t += '<span class="comment__unit-name">';
					t += ("" === nickname.val().trim())? "NO NAME": nickname.val();
					t += '</span>';
					t += "</div>";
					t += "</div>";
					t += "</div>";

					$(".comment__list").append(t);

					comment.val("");
					message.html("コメントありがとうございます！").addClass("comment__message--success").show();
					
					message_none.remove();
				})
				.fail(function(){
					message.html("コメント送信できませんでした。恐れ入りますが、もう一度お試しください。").addClass("comment__message--alert").show();
				})
				.always(function(){
					is_commenting = false;
					
					submit_btn.attr("value", submit_text).removeClass("animation-blinker");
				});     

			} else {

				// コメント処理中
				message.html("コメント送信中です。恐れ入りますが、数秒お待ちいただいてからお試しください。").addClass("comment__message--alert").show();
			}      
		}

		return false;
	});	
});

