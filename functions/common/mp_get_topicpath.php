<?php
/**
 * 現在記事までのすべての親カテゴリの情報を最上位から取得する
 * 対象：固定ページもしくはカテゴリー一覧ページ
 * https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/get_post_ancestors
 * return: array
 */
function mp_get_topicpath() {
	global $post;
	
	$topicpath_array = [];
	
	switch (true) {
		case (is_page()):
			$post_array = get_post_ancestors($post);
			foreach(array_reverse($post_array) as $post_id) {
				array_push($topicpath_array, array(
					"url" => get_permalink($post_id),
					"title" => get_the_title($post_id)
				));
			}	
			break;
        
		case (is_category()):
			$cat = get_queried_object();			
			$cat_array = get_ancestors($cat -> cat_ID, 'category');
			foreach(array_reverse($cat_array) as $post_id) {
				array_push($topicpath_array, array(
					"url" => get_category_link($post_id),
					"title" => get_cat_name($post_id)
				));
			}	
			break;
    
    // default なし
	}
	
	return $topicpath_array;
}
	

