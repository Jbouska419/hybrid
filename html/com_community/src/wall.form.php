<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
?>
<script type="text/javascript" language="javascript">

function wallRemove( id )
{
	if(confirm('<?php echo JText::_('COM_COMMUNITY_WALL_CONFIRM_REMOVE'); ?>'))
	{
		joms.jQuery('#wall_'+id).fadeOut('normal').remove();
		if(typeof getCacheId == 'function') {
			cache_id = getCacheId();
		}else{
			cache_id = "";
		}
		jax.call('community','<?php echo $ajaxRemoveFunc; ?>', id, cache_id );
	}
}

</script>

<div class="cComment-Avatar cFloat-L">
	<a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id );?>"><img class="avatar" alt="" src="<?php echo $my->getThumbAvatar()?>"></a>
</div>

<div class="cComment-Body">
	<div class="cStream-Respond">
		<div class="cStream-Form" data-type="wall-newcomment" style="display: block;">
			<form class="reset-gap">
				<div class="joms-stream-input-attach">
					<div class="cStream-FormInput">
						<textarea class="cStream-FormText" name="comment"></textarea>
					</div>
					<div class="joms-stream-input-attachbtn joms-icon-camera" data-action="attach">
					</div>
				</div>
				<div class="joms-stream-attachment">
					<div class="joms-loading"><img src="<?php echo JURI::root(true) ?>/components/com_community/assets/ajax-loader.gif"></div>
					<div class="joms-thumbnail"><img></div>
					<span class="joms-fetched-close" data-action="remove-attach"><i class="joms-icon-remove"></i></span>
				</div>
				<div class="cStream-FormSubmit">
					<button data-action="save" class="btn btn-primary btn-small"><?php echo JText::_('COM_COMMUNITY_WALL_ADD_COMMENT'); ?></button>
				</div>
				<input type="hidden" name="autocomplete_url" value="<?php echo CRoute::_('index.php?option=com_community&view=friends&task=ajaxAutocomplete') ?>">
				<input type="hidden" name="unique_id" value="<?php echo $uniqueId ?>">
				<input type="hidden" name="add_function" value="<?php echo $ajaxAddFunction ?>">
			</form>
		</div>
	</div>
</div>