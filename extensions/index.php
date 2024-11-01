<?php
if ($handle = opendir(dirname(__FILE__))) {
	while (false !== ($filex = readdir($handle))) {
		if (strstr($filex,".php") && !strstr($filex,"index.php")) {
			require_once(dirname(__FILE__)."/".$filex);
		}
	}
	closedir($handle);
}
?>