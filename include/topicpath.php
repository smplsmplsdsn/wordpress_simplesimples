<?php if (!is_home()): ?>
<?php
$topicpath = mp_get_topicpath();
$topicpath_text = '';

switch (true) {
	case (is_single()):
		$cat = get_the_category();
		$topicpath_text .= get_category_parents($cat[0], true, '');
		$topicpath_text .= '<strong class="topicpath__current">'.get_the_title().'</strong>';
		break;
    
	case is_page():
		foreach($topicpath as $cat) {
			$topicpath_text .= '<a href="'.$cat["url"].'">';
			$topicpath_text .= $cat["title"];
			$topicpath_text .= '</a>';
		}
		$topicpath_text .= '<strong class="topicpath__current">'.get_the_title().'</strong>';
		break;

	case is_category():
		foreach($topicpath as $cat) {
			$topicpath_text .= '<a href="'.$cat["url"].'">';
			$topicpath_text .= $cat["title"];
			$topicpath_text .= '</a>';
		}
		$topicpath_text .= '<strong class="topicpath__current">'.single_cat_title("", false).'</strong>';
		break;
    
  case is_search():
		$topicpath_text .= '「'.$s.'」にヒットした記事一覧';
		break;
		
	case (is_404()):
		$topicpath_text .= '<strong class="topicpath__current">お探しのページは見つかりませんでした</strong>';
		break;
    
	// default なし
}
?>
<div class="topicpath">
	<p class="topicpath__inner">
		<a href="/"><span class="icon-home" title="simple simples design"></span></a>
		<span><?php echo $topicpath_text; ?></span>
	</p>
</div>
<?php endif; ?>
