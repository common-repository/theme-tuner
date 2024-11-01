<?php


function tt_subpages($args) {
	global $post;

	if ($post->post_parent) {
		$i=$post->post_parent;
	} else {
		$i=$post->ID;
	}
	$title = get_the_title($i);
	$argsMenu = array(
    		'depth'        => 1,
	    	'title_li'     => __(''),
			'echo' => 0,
			'child_of'     => $i,
    		'sort_column'  => 'menu_order, post_title',
	);
	$p=wp_list_pages($argsMenu);

	if ($p) {
		extract($args);
		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;
		echo '<ul>'.$p.'</ul>';
		echo $after_widget;
	}
}

function tt_subpages_init()
{
	wp_register_sidebar_widget('theme-tuner',__('Theme Tuner Subpages'), 'tt_subpages');
}
add_action("plugins_loaded", "tt_subpages_init");
