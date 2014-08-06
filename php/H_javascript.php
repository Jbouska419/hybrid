<?php
class H_javascript
{
	public $jquery = 'templates/hybrid/bower_components/jquery/dist/jquery.min.js';
	public $bootstrap = 'templates/hybrid/bower_components/bootstrap/dist/js/bootstrap.min.js';
	public $lesswatch = 'templates/hybrid/bower_components/lesswatch/lwc.js';
	public $html5shiv = 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js';
	public $respond = 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js';
	
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
			case 'html5shiv':
        		echo '<script src="'.$this->html5shiv.'"></script>';
        	break;
			case 'respond':
        		echo '<script src="'.$this->respond.'"></script>';
        	break;
		}
    }
}
?>