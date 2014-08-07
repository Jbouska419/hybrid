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
$app = JFactory::getApplication();
$wishlist_id = $app->getUserState( HIKASHOP_COMPONENT.'.wishlist_id','0');
$cart_type = $app->getUserState( HIKASHOP_COMPONENT.'.popup_cart_type','cart');
$app->setUserState( HIKASHOP_COMPONENT.'.popup_cart_type','cart');
?>
<script type="text/javascript">
setTimeout( 'window.parent.hikashop.closeBox()', <?php echo (int)$this->config->get('popup_display_time',2000);?> );
</script>
<?php
if($cart_type == 'cart' || hikashop_loadUser() != null){
?>
<div id="hikashop_notice_box_content" class="hikashop_notice_box_content" >
	<div id="hikashop_notice_box_message" >
		<?php
		if($cart_type == 'wishlist'){
			echo hikashop_display(JText::_('PRODUCT_SUCCESSFULLY_ADDED_TO_WISHLIST'),'success',true);
		}else{
			echo hikashop_display(JText::_('PRODUCT_SUCCESSFULLY_ADDED_TO_CART'),'success',true);
		}
		?>
	</div>
	<br />
	<div id="hikashop_add_to_cart_continue_div">
		<?php echo $this->cartClass->displayButton(JText::_('CONTINUE_SHOPPING'),'continue_shopping',$this->params,'','window.parent.hikashop.closeBox(); return false;','id="hikashop_add_to_cart_continue_button"'); ?>
	</div>
	<?php if($cart_type == 'wishlist'){ ?>
	<div id="hikashop_add_to_cart_checkout_div">
		<?php
		if($wishlist_id != 0)
			echo $this->cartClass->displayButton(JText::_('DISPLAY_THE_WISHLIST'),'wishlist',$this->params,hikashop_completeLink('cart&task=showcart&cart_id='.$wishlist_id.'&cart_type='.$cart_type.$this->url_itemid),'window.top.location = \''.hikashop_completeLink('cart&task=showcart&cart_id='.$wishlist_id.'&cart_type='.$cart_type.$this->url_itemid).'\';return false;');
		else
			echo $this->cartClass->displayButton(JText::_('DISPLAY_THE_WISHLISTS'),'wishlist',$this->params,hikashop_completeLink('cart&task=showcarts&cart_type='.$cart_type.$this->url_itemid),'window.top.location = \''.hikashop_completeLink('cart&task=showcarts&cart_type='.$cart_type.$this->url_itemid).'\';return false;');
		?>
	</div>
	<?php } else{ ?>
	<div id="hikashop_add_to_cart_checkout_div">
		<?php echo $this->cartClass->displayButton(JText::_('PROCEED_TO_CHECKOUT'),'to_checkout',$this->params,hikashop_completeLink('checkout'.$this->url_itemid),'window.top.location=\''.hikashop_completeLink('checkout'.$this->url_itemid).'\';return false;','id="hikashop_add_to_cart_checkout_button"'); ?>
	</div>
	<?php } ?>
</div>
<?php
	}else{
		$app->enqueueMessage(JText::_('LOGIN_REQUIRED_FOR_WISHLISTS'));
	}
?>
