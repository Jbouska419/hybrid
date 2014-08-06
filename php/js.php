<?php
class hybird_JS
{
	public $jquery = '../bower_components/jquery/dist/jquery.min.js';
	public $bootstrap = '../bower_components/bootstrap/dist/js/bootstrap.min.js';
	public $lesswatch = '../bower_components/lesswatch/lwc.js';
	
    function load($shorthand)
    {
    	switch ($shorthand){
    		case 'jquery':
        		echo '<script src="'.$jquery.'"></script>';
        	break;
    		case 'bootstrap':
        		echo '<script src="'.$bootstrap.'"></script>';
        	break;
    		case 'lesswatch':
        		echo '<script src="'.$lesswatch.'"></script>';
        	break;
		}
    }
}
?>