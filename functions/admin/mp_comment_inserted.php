<?php
/**
 * コメントがあったときに処理を実行する
 */
function mp_comment_inserted($comment_id, $comment_object) {
    
  file_put_contents(__DIR__.'/include/data-post-comment.php', 'これテス');
}
// add_action('wp_insert_comment', 'mp_comment_inserted', 99, 2);