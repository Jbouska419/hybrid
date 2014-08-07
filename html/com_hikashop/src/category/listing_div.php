<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.2
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
$mainDivName=$this->params->get('main_div_name');
$carouselEffect=$this->params->get('carousel_effect');
$enableCarousel=$this->params->get('enable_carousel');

$textCenterd=$this->params->get('text_center');
$this->align="left";
if($textCenterd){
	$this->align="center";
}
$height=$this->params->get('image_height');
$width=$this->params->get('image_width');
$borderClass="";

if($this->params->get('border_visible',1) == 1){
	$borderClass="hikashop_subcontainer_border";
}
if($this->params->get('border_visible',1) == 2){
	$borderClass="thumbnail";
}
if(empty($width) && empty($height)){
 	$width=$this->image->main_thumbnail_x;
		$height=$this->image->main_thumbnail_y;
}
$exists=false;
if(!empty($this->rows)){
	$row=reset($this->rows);
	if(!empty($row->file_path)){
		jimport('joomla.filesystem.file');
		if(JFile::exists($row->file_path)){
			$exists=true;
		}else{
		$exists=false;
		}
	}
}
if(!$exists){
	$config = hikashop_config();
	$path = $config->get('default_image');
	if($path == 'barcode.png'){
		$file_path=HIKASHOP_MEDIA.'images'.DS.'barcode.png';
	}
	if(!empty($path)){
		jimport('joomla.filesystem.file');
		if(JFile::exists($this->image->main_uploadFolder.$path)){
			$exists=true;
		}
	}else{
		$exists=false;
	}
	if($exists){
		$file_path=$this->image->main_uploadFolder.$path;
	}
}else{
	$file_path=$this->image->main_uploadFolder.$row->file_path;
}
if(!empty($file_path)){
	if(empty($width)){
	 	$imageHelper=hikashop_get('helper.image');
	 	$theImage = new stdClass();
		list($theImage->width, $theImage->height) = getimagesize($file_path);
		list($width, $height) = $imageHelper->scaleImage($theImage->width, $theImage->height, 0, $height);
	}
	if(empty($height)){
	 	$imageHelper=hikashop_get('helper.image');
	 	$theImage = new stdClass();
		list($theImage->width, $theImage->height) = getimagesize($file_path);
		list($width, $height) = $imageHelper->scaleImage($theImage->width, $theImage->height, $width, 0);
	}
}
$this->newSizes = new stdClass();
$this->newSizes->height=$height;
$this->newSizes->width=$width;
$this->image->main_thumbnail_y=$height;
$this->image->main_thumbnail_x=$width;



if(!empty($this->rows)){
	$pagination = $this->config->get('pagination','bottom');
	if(in_array($pagination,array('top','both')) && $this->params->get('show_limit') && $this->pageInfo->elements->total > $this->pageInfo->limit->value){ $this->pagination->form = '_top'; ?>
	<form action="<?php echo hikashop_currentURL();?>" method="post" name="adminForm_<?php echo $this->params->get('main_div_name').$this->category_selected;?>_top">
		<div class="hikashop_subcategories_pagination hikashop_subcategories_pagination_top">
		<?php echo $this->pagination->getListFooter($this->params->get('limit')); ?>
		<span class="hikashop_results_counter"><?php echo $this->pagination->getResultsCounter(); ?></span>
		</div>
		<input type="hidden" name="filter_order_<?php echo $this->params->get('main_div_name').$this->category_selected;?>" value="<?php echo $this->pageInfo->filter->order->value; ?>" />
		<input type="hidden" name="filter_order_Dir_<?php echo $this->params->get('main_div_name').$this->category_selected;?>" value="<?php echo $this->pageInfo->filter->order->dir; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php } ?>
	<div class="hikashop_subcategories">
	<?php

	if($enableCarousel){
		$this->setLayout('carousel');
		echo $this->loadTemplate();
	}
	else{

		$columns = (int)$this->params->get('columns');
		if(empty($columns) || $columns<1) $columns = 1;
		$width = (int)(100/$columns)-1;
		$current_column = 1;
		$current_row = 1;
		if($this->params->get('only_if_products','-1')=='-1'){
			$config =& hikashop_config();
			$defaultParams = $config->get('default_params');
			$this->params->set('only_if_products',@$defaultParams['only_if_products']);
		}
		$only_if_products = $this->params->get('only_if_products',0);

		if(HIKASHOP_RESPONSIVE) {
			switch($columns) {
				case 12:
				case 6:
				case 4:
				case 3:
				case 2:
				case 1:
					$row_fluid = 12;
					$span = $row_fluid / $columns;
					break;
				case 10:
				case 8:
				case 7:
					$row_fluid = $columns;
					$span = 1;
					break;
				case 5:
					$row_fluid = 10;
					$span = 2;
					break;
				case 9: // special case
					$row_fluid = 10;
					$span = 1;
					break;
			}
			if($row_fluid == 12)
				echo '<div class="row-fluid"><ul class="thumbnails">';
			else
				echo '<div class="row-fluid-'.$row_fluid.'"><ul class="thumbnails">';
		}

		foreach($this->rows as $row){
			if($only_if_products && $row->number_of_products<1)
				continue;

			if(!HIKASHOP_RESPONSIVE) {
?>
			<div class="hikashop_category hikashop_category_column_<?php echo $current_column; ?> hikashop_category_row_<?php echo $current_row; ?>" style="width:<?php echo $width;?>%;">
				<div class="hikashop_container">
					<div class="hikashop_subcontainer <?php echo $borderClass; ?>">
<?php
			} else {
?>
			<li class="span<?php echo $span; ?> hikashop_category hikashop_category_column_<?php echo $current_column; ?> hikashop_category_row_<?php echo $current_row; ?>">
				<div class="hikashop_container">
					<div class="hikashop_subcontainer <?php echo $borderClass; ?>">
<?php
			}
			$this->row =& $row;
			echo $this->loadTemplate($this->params->get('div_item_layout_type'));
			if($this->params->get('child_display_type','inherit')=='inherit'){
				$config =& hikashop_config();
				$defaultParams = $config->get('default_params');
				$this->params->set('child_display_type',$defaultParams['child_display_type']);
			}
			if($this->params->get('child_limit','')==''){
				$config =& hikashop_config();
				$defaultParams = $config->get('default_params');
				$this->params->set('child_limit',$defaultParams['child_limit']);
			}
			switch($this->params->get('child_display_type')){
				case 'nochild':
				default:
					break;
				case 'allchildsexpand':
					$limit = $this->params->get('child_limit');
				case 'allchilds':
					if(!empty($this->row->childs)){
?>
						<ul class="hikashop_category_list">
<?php
						$i=0;
						foreach($this->row->childs as $child){
							if($only_if_products && $child->number_of_products<1)
								continue;
							if(!empty($limit) && $i >= $limit){
								break;
							}
							$i++;
							$link = hikashop_completeLink('category&task=listing&cid='.$child->category_id.'&name='.$child->alias.$this->menu_id);
?>
							<li class="hikashop_category_list_item">
								<a href="<?php echo $link; ?>">
<?php
									echo $child->category_name;

									if($this->params->get('number_of_products',0)){
										echo ' ('.$child->number_of_products.')';
									}
?>
								</a>
							</li>
<?php
						}

?>
						</ul>
<?php
					}
					break;
			}

			if(!HIKASHOP_RESPONSIVE) {
?>
					</div>
				</div>
			</div>
<?php
			} else {
?>
					</div>
				</div>
			</li>
<?php
			}
			if($current_column>=$columns){
				$current_row++;

				if(!HIKASHOP_RESPONSIVE) {
?>
			<div style="clear:both"></div>
<?php
				}
				$current_column=0;
			}
			$current_column++;
		}

		if(HIKASHOP_RESPONSIVE) {
			echo '</ul></div>';
		}
	}

	?><div style="clear:both"></div>

	</div>
	<?php if(in_array($pagination,array('bottom','both')) && $this->params->get('show_limit') && $this->pageInfo->elements->total > $this->pageInfo->limit->value){ $this->pagination->form = '_bottom'; ?>
	<form action="<?php echo hikashop_currentURL();?>" method="post" name="adminForm_<?php echo $this->params->get('main_div_name').$this->category_selected;?>_bottom">
		<div class="hikashop_subcategories_pagination hikashop_subcategories_pagination_bottom">
		<?php echo $this->pagination->getListFooter($this->params->get('limit')); ?>
		<span class="hikashop_results_counter"><?php echo $this->pagination->getResultsCounter(); ?></span>
		</div>
		<input type="hidden" name="filter_order_<?php echo $this->params->get('main_div_name').$this->category_selected;?>" value="<?php echo $this->pageInfo->filter->order->value; ?>" />
		<input type="hidden" name="filter_order_Dir_<?php echo $this->params->get('main_div_name').$this->category_selected;?>" value="<?php echo $this->pageInfo->filter->order->dir; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php }
}


?>
