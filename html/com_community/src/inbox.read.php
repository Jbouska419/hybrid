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

if(! empty($messages))
{
?>
	<script type="text/javascript">
		function cAppendReply(html, id){
			joms.jQuery('div.ajax-wait').remove();
			joms.jQuery('textarea#replybox').attr('disabled', false);
			joms.jQuery('button#replybutton').attr('disabled', false);
			joms.jQuery('textarea#replybox').val('');
			if (typeof id !== 'undefined') {
				joms.jQuery('#message-'+id).replaceWith(html);
			} else {
				joms.jQuery('#community-wrap div#inbox-messages').append(html);
			}
		}

		joms.jQuery(document).ready(function() {
			joms.jQuery('a.cInbox-ShowMore').click(function(e) {
				e.preventDefault();
				joms.jQuery('#cInbox-Recipients').removeClass('hide');
				joms.jQuery(this).addClass('hide');
			});
		});
	</script>
	<div class="cMail-Actors">
		<?php echo $messageHeading;?>
		<?php
			// Generate recipient names.
			echo '<span id="cInbox-Recipients" class="hide">';
			$i = 0;

			$profile = 'index.php?option=com_community&view=profile&userid=';
			// Add owner name in the header
			if ($parentData->from != $my->id) {
				$user	  = CFactory::getUser( $parentData->from );
				$userLink = CRoute::_($profile . $parentData->from );
				echo '<a href="' . $userLink .'">' . $user->getDisplayName(). '</a>';
				$i++;
			}

			// Generate recipient name in the header.
			foreach ($recipient as $row) {
				if ($my->id != $row->to ) {
					if ($i >= 1) echo ', ';
					$user	  = CFactory::getUser( $row->to );
					$userLink = CRoute::_($profile . $row->to );
					echo '<a href="' . $userLink .'">' . $user->getDisplayName(). '</a>';
					$i++;
				}
			}
			echo '</span>';
		?>
	</div>
	<div id="community-walls">
		<div class="cMail-Streams" id="inbox-messages">
			<?php echo $htmlContent; ?>
		</div>
		<a name="latest"></a>
		<div class="cMail-Compose clearfix">
			<div class="cMessage-Avatar cFloat-L">
				<?php
					$user = CFactory::getUser();
				?>
				<img src="<?php echo $user->getThumbAvatar(); ?>" width="48" class="cAvatar" />
			</div>
			<div class="cMessage-Body">
				<div class="cStream-Respond">
					<div data-type="wall-newcomment" style="margin-top:0">
						<form class="reset-gap">
							<div class="joms-stream-input-attach">
								<div class="cStream-FormInput cWall-Form">
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
								<button data-action="save" class="btn btn-primary btn-small"><?php echo JText::_('COM_COMMUNITY_ADD_REPLY_BUTTON'); ?></button>
							</div>
							<input type="hidden" name="autocomplete_url" value="<?php echo CRoute::_('index.php?option=com_community&view=friends&task=ajaxAutocomplete') ?>">
							<input type="hidden" name="unique_id" value="<?php echo $parentData->id ?>">
							<input type="hidden" name="add_function" value="inbox,ajaxAddReply">
						</form>
					</div>
				</div>
				<br>&nbsp;
			</div>
		</div>
	</div>
<?php } else { ?>
	<?php echo $htmlContent; ?>
<?php } ?>