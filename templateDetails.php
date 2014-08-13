<?php header('Content-Type: text/xml'); ?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE install PUBLIC "-//Joomla! 2.5//DTD template 1.0//EN" "http://www.joomla.org/xml/dtd/2.5/template-install.dtd">
<extension version="3.1" type="template" client="site">
	<name>Hybrid</name>
	<version>1.0</version>
	<creationDate>8/5/2014</creationDate>
	<author>Anthony Fuentes and James Bouska</author>
	<authorEmail>antfuentes87@gmail.com</authorEmail>
	<copyright>Copyright (C) 2014 MNDYRS. All rights reserved.</copyright>
	<description>A hybrid template using Bower and Git</description>
	<files>
		<filename>index.php</filename>
		<filename>README.md</filename>
		<filename>templateDetails.xml</filename>
		<folder>bower_components</folder>
		<folder>css</folder>
		<folder>html</folder>
		<folder>_less</folder>
		<folder>php</folder>
		<folder>include</folder>
	</files>
	<positions>
		<position>debug</position>
		<?php
			if(file_exists('include/positions.php')){
  				require_once('include/positions.php');
			}
		?>
	</positions>
</extension>