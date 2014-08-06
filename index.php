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
			<!--[if lt IE 9]>
				<script src="<?php $js->load('html5shiv'); ?>"></script>
				<script src="<?php $js->load('respond'); ?>"></script>
			<![endif]-->
		</head>
		<body>
                	<jdoc:include type="modules" name="menu" />
                	<jdoc:include type="message" />
					<jdoc:include type="component" />
                    <!-- Example Usage of Hybrid Javascript Class // Just uncomment to load that library -- complete list of shorthand is in php/H_javascript.php -->
                    <?php //$js->load('jquery'); ?>
                    <?php //$js->load('bootstrap'); ?>
		</body>
</html>
