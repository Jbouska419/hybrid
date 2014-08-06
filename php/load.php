<?php
$dir    = 'templates/hybrid/php/';
$scanned_directory = array_diff(scandir($dir), array('..', '.','load.php','H_vars.php'));

require_once('H_vars.php');

foreach ($scanned_directory as $filePath) {
		require_once($filePath);
}
?>