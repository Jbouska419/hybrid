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
<div id="wall_<?php echo $id; ?>" class="cComment clearfix" data-type="wall-comment" data-id="<?php echo $id; ?>">
	<!-- END: .cComment-Avatar -->
	<div class="cComment-Avatar cFloat-L"><?php echo $avatarHTML; ?></div>
	<!-- END: .cComment-Avatar -->

	<!-- END: .cComment-Body -->
	<div class="cComment-Body">
		<a href="<?php echo $authorLink; ?>" class="cComment-Author"><?php echo $author; ?></a>

		<!-- END: .cComment-Content -->
		<div class="cComment-Content">
			<div id="wall-message-<?php echo $id;?>" data-type="wall-message">
				<span><?php echo $content ?></span>
				<?php if ( !empty( $photoThumbnail ) ) { ?>
				<div style="padding: 5px 0"><img class="joms-stream-thumb" src="<?php echo $photoThumbnail; ?>" /></div>
				<?php } else if ($paramsHTML) { ?>
				<?php echo $paramsHTML; ?>
				<?php } ?>
			</div>
			<?php if($isEditable) { ?>
			<div id="wall-edit-container-<?php echo $id;?>" data-type="wall-editor" style="display: none">
				<div class="cStream-Respond">
					<div class="cStream-Form" style="display: block;">
						<form class="reset-gap">
							<div class="joms-stream-input-attach">
								<div class="cStream-FormInput">
									<textarea class="cStream-FormText" name="comment"></textarea>
								</div>
								<div class="joms-stream-input-attachbtn joms-icon-camera" data-action="attach">
								</div>
							</div>
							<div class="joms-stream-attachment"<?php echo $photoThumbnail ? ' style="display:block"' : ' data-no_thumb="1"' ?>>
								<div class="joms-loading"><img src="<?php echo JURI::root(true) ?>/components/com_community/assets/ajax-loader.gif"></div>
								<div class="joms-thumbnail"<?php echo $photoThumbnail ? ' style="display:block"' : '' ?>><img<?php echo $photoThumbnail ? (' src="' . $photoThumbnail . '" data-photo_id="0"') : '' ?>></div>
								<span class="joms-fetched-close" data-action="remove-attach"<?php echo $photoThumbnail ? ' style="display:block"' : '' ?>><i class="joms-icon-remove"></i></span>
							</div>
							<div class="cStream-FormSubmit">
								<a class="cStream-FormCancel" href="javascript:" data-action="cancel"><?php echo JText::_('COM_COMMUNITY_CANCEL_BUTTON'); ?></a>
								<button data-action="save" class="btn btn-primary btn-small"><?php echo JText::_('COM_COMMUNITY_EDIT_COMMENT_BUTTON'); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php echo $commentsHTML; ?>
		</div>
		<!-- END: .cComment-Content -->

		<!-- START: .cComment-Meta -->
		<div class="cComment-Meta small">
			<?php echo $created; ?>

			<?php if($config->get('wallediting')){ ?>

				<?php if($isEditable){?>
					&middot;
					<?php echo '<a href="javascript:" data-action="edit" rel="' . $id . '::' .  $processFunc . '">' . JText::_('COM_COMMUNITY_EDIT') . '</a>';?>
				<?php } ?>

			<?php } ?>

			<?php if($isMine) { ?>
				&middot;
				<a onclick="wallRemove(<?php echo $id; ?>);return false;" href="javascript:void(0)" class="remove" ><?php echo JText::_('COM_COMMUNITY_WALL_REMOVE');?></a>
			<?php } ?>
		</div>
		<!-- END: .cComment-Meta -->
	</div>
	<!-- END: .cComment-Body -->
</div>

