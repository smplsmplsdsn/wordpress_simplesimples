<?php
/**
 * リスト用ユニット
 * ATTENTION mp_get_thumbnail.php を読み込んでいること
 *
 * @param {string} $post_id* 記事ID
 * @param {number} $post_description_maxlength
 * @return {string}
 */
function mp_html_list_unit($post_id, $post_description_maxlength = 80) {

	// the_category(', ');
	$post_category = get_the_category($post_id);
	$post_category = $post_category[0];
	$post_category_base = $post_category -> slug;
	$post_category_name = $post_category -> name; 

	$sngl = get_post($post_id);
	$post_content = $sngl -> post_content;
	$desciption = strip_tags($post_content);

	$is_more = (mb_strlen($desciption, 'UTF-8') > $post_description_maxlength);
	$desciption = mb_substr($desciption, 0, $post_description_maxlength, 'UTF-8');
	if ($is_more) {
		$desciption = $desciption."...";
	}

	$post_img = mp_get_thumbnail($post_id, $post_category_base, $post_content);
  
  $output = '
<section class="list-unit">
  <a class="list-unit__link" href="'.get_the_permalink($post_id).'">
    <div class="list-unit__inner">
      <figure class="list-unit__figure">
        <span class="list-unit__bg" style="background-image: url('.$post_img.');"></span>
      </figure>
      <div class="list-unit__text">
        <h1 class="list-unit__title">'.wp_strip_all_tags(get_the_title($post_id)).'</h1>
        <p class="list-unit__description">'.wp_strip_all_tags($desciption).'</p>
        <p class="list-unit__category-and-date">
          <time class="list-unit__date" datetime="'.get_the_time('Y-m-d\TH:i', $post_id).'">'.get_the_time('Y年n月j日', $post_id).'</time>
          <span class="list-unit__category">'.$post_category_name.'</span>
        </p>
      </div>
    </div>
  </a>
</section>  
  ';
	return $output;
}