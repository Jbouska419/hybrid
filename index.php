<?php 
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
            <?php
			if(file_exists('templates/'.$this->template.'/include/head.php')){
  				require_once('templates/'.$this->template.'/include/head.php');
			}else{
				echo 'Can not find head.php @ templates/'.$this->template.'/include/';
			}
			?>
		</head>
		<body>
			<?php
			if(file_exists('templates/'.$this->template.'/include/body.php')){
  				require_once('templates/'.$this->template.'/include/body.php');
			}else{
				echo 'Can not find body.php @ templates/'.$this->template.'/include/';
			}
			?>
		</body>
</html>
