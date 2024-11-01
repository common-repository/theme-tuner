<?php
add_action('admin_menu', 'zing_tt_cp');

function zing_tt_cp() {
	add_options_page("Theme Tuner Options", "Theme Tuner", 'manage_options', 'tt-admin', 'zing_tt_cp_settings');
}

function zing_tt_cp_settings() {
	if (!session_id()) @session_start();
	echo '<div class="wrap">';
	echo '<div id="cc-left" style="position:relative;float:left;width:100%">';
	echo '<h3>Settings</h3>';
	echo "You can turn the theme tuner editor on and off for the duration of a session.<br />";
	if (isset($_POST['tt-new-status']) && $_POST['tt-new-status']) $_SESSION['zing']['tt']['status']=$_POST['tt-new-status'];
	if (isset($_SESSION['zing']['tt']['status']) && ($_SESSION['zing']['tt']['status']=='On')) {
		$newstatus='Off';
	} else {
		$newstatus='On';
	}
	echo '<form method="post" action="?page=tt-admin">';
	echo '<input type="submit" name="tt-new-status" value="'.$newstatus.'" />';
	echo '</form>';
	echo '</div>';
	echo '</div>';
}
?>