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
	<?php if( $announcements ) {?>
	<h3 class="cStreamTitle cResetH"><?php echo JText::_('COM_COMMUNITY_GROUPS_ANNOUNCEMENT_UPDATE_TITLE'); ?></h3>
	<ul class="cStreamList forAnnouncement pushedUp cResetList">
		<?php foreach($announcements as $announcement){ ?>
		<li>
			<div class="joms-stream-avatar">
				<img src="<?php echo $announcement['user_avatar']; ?>" class="cAvatar" />
			</div>
			<div class="joms-stream-content">
				<div class="cStream-Headline">
					<a href="<?php echo $announcement['announcement_link'] ?>" ><?php echo $announcement['title']; ?></a>
					<span class="arrow">&#9654;</span>
					<a href="<?php echo $announcement['group_link']; ?>" > <?php echo $announcement['group_name']; ?> </a>
				</div>
				<div class="cStream-Attachment">
					<?php echo $announcement['message']; ?>
				</div>
				<div class="cStream-Actions small">
					<span><?php echo $announcement['user_name'];?></span>
					<span><?php echo $announcement['created_interval']; ?></span>
				</div>
			</div>
		</li>
		<?php } ?>
	</ul>
	<?php } ?>