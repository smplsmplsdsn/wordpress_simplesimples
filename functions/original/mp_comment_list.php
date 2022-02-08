<?php
/**
 * 最近コメントのあったリストを取得する
 */
function mp_comment_list() {
	$output = '';
  
  $comment_maxnum = 15;
  $comment_num = 0;
  $comment_array = array();

  $args_comment = array(
    'type' => 'comment',
    'status' => 'approve',
  );

  $comments = get_comments($args_comment);
  
  foreach ($comments as $comment) {

    $post_id = $comment -> comment_post_ID;

    if (in_array($post_id, $comment_array)) {
      continue;
    } else if ($comment_num < $comment_maxnum) {
      $comment_num++;
      $comment_array[] = $post_id;

      $output .= mp_get_post_for_list($post_id);

    } else {
      break;
    }  
  }  
	return $output;
}
