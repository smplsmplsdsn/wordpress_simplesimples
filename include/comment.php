<aside class="comment js-comment">
	<div class="comment__inner">
		<h1 class="comment__title">COMMENT</h1>
		<p class="comment__description js-comment__description">最後まで目を通していただき、ありがとうございます。この記事はいかがでしたか？</p>
		<div class="comment__form-outer">
			<form id="commentform" class="comment__form js-form-comment" data-action="<?php echo home_url('/wp-comments-post.php'); ?>" method="post">
				<textarea name="comment"></textarea>
				<div class="comment__info">
					<input class="comment__name" name="author" type="text" value="" placeholder="ニックネーム">
					<input class="comment__submit js-comment-submit" name="submit" type="submit" value="コメントする">
				</div>
				<input type="hidden" name="comment_post_ID" value="<?php the_id(); ?>">
				<input type="hidden" name="comment_parent" value="0" />
				<p class="comment__message js-comment-message"><strong>コメント送信できませんでした。恐れ入りますが、コメントが入力されていることをご確認の上、もう一度「コメント送信」を選択してください。</strong></p>
			</form>
		</div>

		<div class="comment__list">
			<?php
			$comments = get_comments('post_id='.get_the_id().'&status=approve&type=comment&orderby=comment_date&order=ASC');

			function check_author($author_name) {
				if ("" === $author_name) {
					$author_name = "(匿名)";
				}
				return enc($author_name);
			}
			
			function view_comment($comments) {
				$t = '';
				if (count($comments) > 0) {
					foreach ( $comments as $comment ) {
						$t .= '<div class="comment__unit-outer" id="comment-'.$comment -> comment_ID.'">';
						$t .= '<div class="comment__unit">';
						$comment_text = $comment -> comment_content;
						$comment_text = preg_replace('/&lt;/', '＜', $comment_text);
						$comment_text = preg_replace('/&gt;/', '＞', $comment_text);        
						$t .= replace_br(enc($comment_text));
						$t .= '<div class="comment__unit-info">';
						$t .= '<span class="comment__unit-name">';
						$t .= check_author($comment -> comment_author);
						$t .= '</span>';
						$t .= '<time class="comment__unit-time" datetime="'.date("Y-m-d\TH:i", strtotime($comment -> comment_date)).'">';
						$t .= date("Y年m月d日 H:i", strtotime($comment -> comment_date));
						$t .= '</time>';
						$t .= "</div>";
						$t .= "</div>";
						$t .= "</div>";
					}
				} else {
					$t .= '<p class="comment__none js-comment-none">この記事の最初のコメントを書いてくれると嬉しいです！</p>';
				}
				return $t;
			}
			echo view_comment($comments);
			?>    
		</div>  
	</div>
</aside> 