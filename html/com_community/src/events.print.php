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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title><?php echo $this->escape($event->title); ?></title>
  <?php echo $script; ?>

  <style type="text/css">
	h1{
		font-size:180%;
	}
	body {
		color:#333333;
		font-family:Helvetica,Arial,sans-serif;
		font-size:12px;
		line-height:1.3em;
	}

	td{
		font-size:12px;
	}
  </style>
  </head>
  <body>

  	<!-- Header -->
  	<table width="100%">
		<!-- title -->
		<tr>
			<td width="10%"><img width ="64" src="<?php echo $event->getAvatar();?>"/></td>
			<td width="70%"><h1><?php echo $this->escape($event->title); ?></h1></td>
			<td width="20%" align="right"><a href="javascript:window.print();"><?php echo JText::_('COM_COMMUNITY_EVENTS_PRINT'); ?></a></td>
		</tr>
	</table>

  	<hr/>
	<table width="100%">
		<!-- Location -->
		<tr>
			<td><strong><?php echo JText::_('COM_COMMUNITY_EVENTS_LOCATION');?></strong></td>
			<td><?php echo $this->escape($event->location); ?></td>
		</tr>

		<!-- Time -->
		<tr>
			<td><strong><?php echo JText::_('COM_COMMUNITY_EVENTS_TIME');?></strong></td>
			<td><?php echo JText::sprintf('COM_COMMUNITY_EVENTS_DURATION', $event->startdateHTML, $event->enddateHTML) ?>
				<br/>
				<?php
                                if( $config->get('eventshowtimezone') ) {
                                    echo $creatorUtcOffsetStr;
                                }
                                ?>
			</td>
		</tr>


		<!-- Creator -->
		<tr>
			<td><strong><?php echo JText::_('COM_COMMUNITY_EVENTS_CREATOR');?></strong></td>
			<td><?php echo $this->escape($event->getCreatorName()); ?></td>
		</tr>

		<tr>
			<td colspan="2"><hr/></td>
		</tr>

		<?php

  		if(CMapping::validateAddress($event->location)){
  		?>
		<tr>
			<td colspan="2">
			<!-- begin: static map -->
          		<?php echo CMapping::drawStaticMap($event->location, 578, 500); ?>
          	<!-- end: static map -->
			</td>
		</tr>
		<?php } ?>
	</table>
	<script type="text/javascript">
		setTimeout('window.print();', 2000);
	</script>
  </body>
</html>