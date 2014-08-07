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

<div class="cInbox-Stream<?php if(isset($isMine) && $isMine) echo ' Mine'?> clearfix" id="message-<?php echo $msg->id; ?>" data-type="wall-comment" data-id="<?php echo $msg->id; ?>">
	<a href="<?php echo $authorLink;?>" class="cMessage-Avatar cFloat-L">
		<img src="<?php echo $user->getThumbAvatar(); ?>" alt="<?php echo $user->getDisplayName(); ?>" width="48" class="cAvatar" />
	</a>

	<div class="cMessage-Body">
		<a class="btn btn-small cFloat-R" href="javascript:jax.call('community', 'inbox,ajaxRemoveMessage', <?php echo $msg->id; ?>);" title="<?php echo JText::_('COM_COMMUNITY_INBOX_REMOVE_MESSAGE'); ?>">
			<?php echo JText::_('COM_COMMUNITY_INBOX_REMOVE_MESSAGE'); ?>
		</a>
		<b class="cMessage-Author">
			<a href="<?php echo $authorLink;?>"><?php echo $user->getDisplayName(); ?></a>
		</b>
		<br />
		<small class="cMessage-Time">
		<?php
			$postdate = CTimeHelper::timeLapse(CTimeHelper::getDate($msg->posted_on));
			echo $postdate;
		?>
		</small>
		<div class="cMessage-Content">
			<?php echo filter_var(htmlspecialchars_decode($content), FILTER_UNSAFE_RAW); ?>
		</div>

		<?php if ($photoThumbnail) { ?>

		<div class="joms-stream-box joms-fetch-wrapper" style="display: inline-block; padding: 5px; position: relative">
			<?php if ( $msg->from == $my->id ) { ?>
			<span style="top:0;right:0;left:auto" class="joms-fetched-close" data-action="remove-thumbnail"><i class="joms-icon-remove"></i></span>
			<?php } ?>
			<img<?php echo $photoThumbnail ? (' src="' . $photoThumbnail . '"') : '' ?>>
		</div>

		<?php } elseif ($params->get('url')) { ?>

		<?php
			$href = 'href="' . $params->get('url') . '" target="_blank"';

			$image = $params->get('image');
			if ( $image && count( $image ) >= 1 ) {
				$image = $image[0];
			} else {
				$image = false;
			}

			$cite = $params->get('url');
			$cite = preg_replace('#^https?://#', '', $cite);
			$cite = preg_replace('#/$#', '', $cite);
		?>
		<div class="joms-stream-box joms-fetch-wrapper clearfix" style="position: relative">
			<?php if ( $msg->from == $my->id ) { ?>
			<span style="top:0;right:0;left:auto" class="joms-fetched-close" data-action="remove-preview"><i class="joms-icon-remove"></i></span>
			<?php } ?>
			<div style="position:relative;">
				<div class="row-fluid">
					<?php if ($image) { ?>
					<div class="span4">
						<a <?php echo $href ?>><img class="joms-stream-thumb" src="<?php echo $image; ?>" /></a>
					</div>
					<?php } ?>
					<div class="span<?php echo $image ? '8' : '12' ?>">
						<article class="joms-stream-fetch-content" style="margin-left:0; padding-top:0">
							<a <?php echo $href ?>><span class="joms-stream-fetch-title"><?php echo $params->get('title'); ?></span></a>
							<span class="joms-stream-fetch-desc"><?php echo CStringHelper::trim_words($params->get('description')); ?></span>
							<cite><?php echo $cite; ?></cite>
						</article>
					</div>
				</div>
			</div>
		</div>

		<?php } ?>
	</div>
</div>
