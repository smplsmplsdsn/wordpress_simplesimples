<?php
/**
 * 記事リストのユニットを取得する
 * トップページと記事投稿ページで利用している
 *
 * @param (string) $id: 記事ID
 * @return (string) htmlコーディング
 */
function mp_get_post_for_list($id) {
	$output = '';
		
	$sngl_id = $id;

	// the_category(', ');
	$sngl_category = get_the_category($sngl_id);
	$sngl_category = $sngl_category[0];
	$sngl_category_base = $sngl_category->slug;
	$sngl_category_name = $sngl_category->name; 

	$sngl = get_post($sngl_id);
	$sngl_content = $sngl->post_content;
	$desciption = strip_tags($sngl_content);

	$is_more = (mb_strlen($desciption, 'UTF-8') > 80);
	$desciption = mb_substr($desciption, 0, 80, 'UTF-8');
	if ($is_more) {
		$desciption = $desciption."...";
	}

	$sngl_img = mp_get_thumbnail($sngl_id, $sngl_category_base, $sngl_content);
	
  $output .= '
<section class="nav-list-unit">
  <a class="nav-list-unit__link" href="'.get_the_permalink($sngl_id).'">
    <div class="nav-list-unit__inner">
      <figure class="nav-list-unit__figure">
        <span class="nav-list-unit__bg" style="background-image: url('.$sngl_img.');"></span>
      </figure>
      <div class="nav-list-unit__text">
        <h1 class="nav-list-unit__title">'.esc_html(get_the_title($sngl_id)).'</h1>
        <p class="nav-list-unit__description">'.esc_html($desciption).'</p>
        <p class="nav-list-unit__category-and-date">
          <time class="nav-list-unit__date" datetime="'.get_the_time('Y-m-d\TH:i', $sngl_id).'">'.get_the_time('Y年n月j日', $sngl_id).'</time>
          <span class="nav-list-unit__category">'.$sngl_category_name.'</span>
        </p>
      </div>
    </div>
  </a>
</section>
  ';
  return $output;
}


