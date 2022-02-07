<?php
/**
 * コメントが保存される前に処理を実行する
 * (実際にはコメントが保存した直後に実行される）
 *
 * https://developer.wordpress.org/reference/hooks/comment_post/
 *
 * ATTENSION: 引数名を変更したり、第2引数、第3引数をセットすると動かなくなる(理解不能...)
 */
function mp_comment_before($comment_ID) {
  $comment_data = get_comment($comment_ID);
  $comment_content = $comment_data -> comment_content;
  
  $post_id = $comment_data -> comment_post_ID;
  $link = get_permalink($post_id);

  // 日本語が含まれているか判別する
  if (strlen($comment_content) != mb_strlen($comment_content, 'utf8')) {
    wp_mail('simplesimplesdesign@gmail.com', 'SIMPLESIMPLESにコメントあり', $link."\n\n".$comment_content);
  } else {
    
    wp_delete_comment($comment_ID);
//  wp_delete_comment($comment_ID, true);
    wp_mail('simplesimplesdesign@gmail.com', 'SIMPLESIMPLESに要チェックコメントあり', '英語のみのコメントの模様'.$comment_content);
  }
}
add_action('comment_post', 'mp_comment_before', 10, 2);
