<?php
class H_javascript
{
	public $jquery = 'templates/hybrid/bower_components/jquery/dist/jquery.min.js';
	public $bootstrap = 'templates/hybrid/bower_components/bootstrap/dist/js/bootstrap.min.js';
	public $lesswatch = 'templates/hybrid/bower_components/lesswatch/lwc.js';
	
    function load($shorthand)
    {
    	switch ($shorthand){
    		case 'jquery':
        		echo '<script src="'.$this->jquery.'"></script>';
        	break;
    		case 'bootstrap':
        		echo '<script src="'.$this->bootstrap.'"></script>';
        	break;
    		case 'lesswatch':
        		echo '<script src="'.$this->lesswatch.'"></script>';
        	break;
		}
    }
}
?>