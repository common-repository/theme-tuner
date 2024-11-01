<?php
/**
 * Displays a 3 mini posts on a page
 * Syntax:
 * 		[theme-tuner:minipost3 x y z]
 * 
 * 		where x, y and z are page ID's 
 */
add_filter('the_content', 'tt_minipost3_content', 10, 3);
add_action('wp_head','tt_minipost3_header');

function tt_minipost3_header() {
	echo '<link rel="stylesheet" type="text/css" href="' . ZING_THEMEZ_URL . 'css/minipost3.css" media="screen" />';
}

function tt_minipost3_content($content) {
	if (preg_match('/\[theme-tuner:(.*)\]/',$content,$matches)==1) { //[zing-ws:page]
		$params=explode(' ',trim($matches[1]));
		if ($params[0]=='3columns') {
			$new='';
			for ($i=1;$i<=3;$i++) {
				$new.='<div class="tt-minipost3">';
				$my_query = new WP_Query('page_id= '.$params[$i]);
				while ($my_query->have_posts()) {
					$my_query->the_post();
					$new.='<div class="hentry">';
					$new.='<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
					$new.=get_the_content();
					$new.='</div>';
				}
				$new.='</div>';
			}
			$content=preg_replace('/\[theme-tuner:(.*)\]/',$new,$content);
		}
	}
	return $content;
}
