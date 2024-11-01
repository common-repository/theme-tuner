<?php

add_filter('the_content', 'tt_widget_area_content', 10, 3);

function tt_widget_area_content($content) {
	if (preg_match('/\[theme-tuner:(.*)\]/',$content,$matches)==1) { //[zing-ws:page]
		$params=explode(' ',trim($matches[1]));
		if ($params[0]=='widget_area') {
			$widget='widget-area-'.'1';
			if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar($widget) ) :
			endif;
		}
	}
	return $content;
}



register_sidebar(array(
   'name' => 'Widget area 1',  
   'id' => 'widget-area-1',  
 	'before_widget' => '',  
   'after_widget' => '',  
   'before_title' => '<h3>',  
   'after_title' => '</h3>'  
   ));