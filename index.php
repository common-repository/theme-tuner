<?php
/*
 Plugin Name: Theme Tuner
 Plugin URI: http://www.choppedcode.com
 Description: Theme Tuner is a plugin that allows you to edit in real-time the look-and-feel of your site.
 Author: choppedcode
 Version: 1.1
 Author URI: http://www.choppedcode.com/
 */

if (!defined("ZING_THEMEZ_PLUGIN")) {
	$zing_themez_plugin=str_replace(realpath(dirname(__FILE__).'/..'),"",dirname(__FILE__));
	$zing_themez_plugin=substr($zing_themez_plugin,1);
	define("ZING_THEMEZ_PLUGIN", $zing_themez_plugin);
}
if (!defined("ZING_THEMEZ_URL")) {
	define("ZING_THEMEZ_URL", WP_PLUGIN_URL . "/".ZING_THEMEZ_PLUGIN."/");
}

add_action('wp_head','zing_themez_header');
add_action('wp_head','zing_themez_styles',999);
add_action("init","zing_themez_init");
add_filter('the_content', 'zing_themez_control', 10, 3);

require(dirname(__FILE__).'/classes/css.class.php');
require(dirname(__FILE__).'/tt_cp.php');
require(dirname(__FILE__).'/extensions/index.php');

function zing_themez_header()
{
	global $zing_tt;

	echo '<link rel="stylesheet" type="text/css" href="' . ZING_THEMEZ_URL . 'css/tt.css" media="screen" />';

	if (!$zing_tt) return;
	echo '<script type="text/javascript" language="javascript">';
	echo "var ttURL='".get_home_url()."/';";
	echo '</script>';

	echo '<script type="text/javascript" src="' . ZING_THEMEZ_URL . 'js/themez.jquery.js"></script>';
	echo '<script type="text/javascript" src="' . ZING_THEMEZ_URL . 'js/jscolor/jscolor.js"></script>';
}

function zing_themez_styles()
{
	echo '<style type="text/css">';
	$tt=new ttCss();
	echo $tt->render();
	echo '</style>';
}

function zing_themez_init() {
	global $zing_tt;
	if (!session_id()) session_start();
	if (isset($_REQUEST['tt-page']) && ($_REQUEST['tt-page']=='savetag')) {
		ob_end_clean();
		require(dirname(__FILE__).'/ajax/savetag.php');
		die();
	}
	if (isset($_SESSION['zing']['tt']['status']) && ($_SESSION['zing']['tt']['status']=="On")) $zing_tt=true; else $zing_tt=false;
	if ($zing_tt) {
		wp_enqueue_script('jquery');
	}
}

function zing_themez_control($content) {
	global $zing_tt;
	if (!$zing_tt) return $content;
	echo '<div id="tt-sidebar"></div>';
}


