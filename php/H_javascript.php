<?php
class H_javascript extends H_vars
{
    function load($shorthand)
    {
    	switch ($shorthand){
    		case 'jquery':
        		echo '<script src="'.$this->JS_jquery.'"></script>';
        	break;
    		case 'bootstrap':
        		echo '<script src="'.$this->JS_bootstrap.'"></script>';
        	break;
    		case 'lesswatch':
        		echo '<script src="'.$this->JS_lesswatch.'"></script>';
        	break;
			case 'html5shiv':
        		echo '<script src="'.$this->JS_html5shiv.'"></script>';
        	break;
			case 'respond':
        		echo '<script src="'.$this->JS_respond.'"></script>';
        	break;
		}
    }
}
?>