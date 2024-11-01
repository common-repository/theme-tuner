<?php
/**
 * Displays a link to a post or page
 * Syntax:
 * 		[theme-tuner:post_link x]
 *
 * 		where x is a post or page ID
 */
add_filter('the_content', 'tt_post_link_content', 10, 3);

function tt_post_link_content($content) {
	if (preg_match_all('/\[theme-tuner:(.*)\]/',$content,$matches)>1) { //[zing-ws:page]
		foreach ($matches[1] as $id => $match) {
			$params=explode(' ',trim($match));
			if ($params[0]=='post_link') {
				$new='';
				$new.='<div class="tt-post_link">';
				$my_query = new WP_Query('page_id= '.$params[1]);
				while ($my_query->have_posts()) {
					$my_query->the_post();
					$new.='<div class="hentry">';
					$new.='<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
					$new.='</div>';
				}
				$new.='</div>';
				$content=str_replace($matches[0][$id],$new,$content);
			}
		}
	}
	return $content;
}
