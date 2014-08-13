<?php 
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<jdoc:include type="head" />
			<!-- Load Single CSS File -->
			<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/load.css">
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
			<?php
			if(file_exists('templates/'.$this->template.'/include/body.php')){
  				require_once('templates/'.$this->template.'/include/body.php');
			}
			?>
		</body>
</html>
