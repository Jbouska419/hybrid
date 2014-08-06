<?php 
defined('_JEXEC') or die; 
require_once ('php/load.php');
$js = new H_javascript();
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
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
                	<jdoc:include type="modules" name="menu" />
                	<jdoc:include type="message" />
					<jdoc:include type="component" />
                    <?php $js->load('jquery'); ?>
                    <?php $js->load('bootstrap'); ?>
		</body>
</html>
