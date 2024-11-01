<?php
/**
 * Displays a table of posts
 *
 * Syntax:
 * 		[theme-tuner:posts_table category]
 *
 * 		where category is the category name of posts to display
 */
add_filter('the_content', 'tt_posts_table_content', 10, 3);
add_action('wp_head','tt_posts_table_header');

define('ttPostsTableDefaultImage',plugins_url().'/theme-tuner/images/logo.png');

function tt_posts_table_header() {
	echo '<link rel="stylesheet" type="text/css" href="' . ZING_THEMEZ_URL . 'css/posts_table.css" media="screen" />';
}


function tt_posts_table_content($content) {
	global $post;
	if (preg_match('/\[theme-tuner:(.*)\]/',$content,$matches)==1) {
		$new='';
		$params=explode(' ',trim($matches[1]));
		if ($params[0]=='posts_table') {
			$new.='<table class="tt-posts_table">';
			if ($params[1]) $my_query = new WP_Query('category_name= '.$params[1]);
			else $my_query = new WP_Query('cat=0');
			while ($my_query->have_posts()) {
				$p=$my_query->the_post();
				$post_id=get_the_ID();
				$custom_field_keys = get_post_custom($post_id);
				$new.='<tr>';
				$idSet=false;
				foreach ( $custom_field_keys as $key => $values ) {
					if ( '_' != $key{0} && $key == 'ID') {
						$new.='<td class="tt_col_'.$key.'">';
						$new.=$values[0];
						$new.='</td>';
						$idSet=true;
					}
				}
				if (!$idSet) {
					$new.='<td class="tt_col_id">';
					$new.=get_the_ID();
					$new.='</td>';
				}
				$new.='<td class="tt_col_image">';
				$new.='<img src="'.catch_that_image(get_the_content()).'" />';
				$new.='</td>';
				$pdf=tt_get_post_pdf();
				if ($pdf) $new.='<td class="tt_col_title"><a href="'.$pdf.'" target="_blank" title="'.get_the_title().'">'.get_the_title().'</a></td>';
				else $new.='<td class="tt_col_title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></td>';
				$new.='<td class="tt_col_excerpt">';
				$new.=$post->post_excerpt;
				$new.='</td>';
				foreach ( $custom_field_keys as $key => $values ) {
					if ( '_' != $key{0} && $key != 'ID') {
						$new.='<td class="tt_col_'.$key.'">';
						$new.=$values[0];
						$new.='</td>';
					}
				}
				$new.='</tr>';
			}
			$new.='</table>';
			$content=preg_replace('/\[theme-tuner:(.*)\]/',$new,$content);
		}
	}
	return $content;
}

function catch_that_image($content) {
	$first_img = '';
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	$first_img = $matches [1] [0];
	if (empty($first_img)){ //Defines a default image
		$first_img = ttPostsTableDefaultImage;
	}
	return $first_img;
}

// get the first PDF attached to the current post
function tt_get_post_pdf() {
	global $post;

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'application/pdf', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($attachments) {
		$attachment = array_shift($attachments);
		return wp_get_attachment_url($attachment->ID);
	}

	return false;
}
