<?php
/**
 * @version    SVN $Id: default.php 1691 2013-10-16 15:14:00Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2011 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      16-Nov-2011 19:45:40
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$user = JFactory::getUser();

$canEdit = ($user->authorise('core.edit', 'com_hwdmediashare.group.'.$this->group->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.group.'.$this->group->id) && ($this->group->created_user_id == $user->id)));
$canEditState = $user->authorise('core.edit.state', 'com_hwdmediashare.group.'.$this->group->id);
$canDelete = ($user->authorise('core.delete', 'com_hwdmediashare.group.'.$this->group->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.group.'.$this->group->id) && ($this->group->created_user_id == $user->id)));
$canAdd = (($this->group->ismember) && (JFactory::getUser()->authorise('hwdmediashare.upload','com_hwdmediashare') || JFactory::getUser()->authorise('hwdmediashare.import','com_hwdmediashare')));

JHtml::_('behavior.tooltip');
JHtml::_('behavior.modal');
?>
  <div id="hwd-container"> <a name="top" id="top"></a>
    <!-- Media Navigation -->
    <?php echo hwdMediaShareHelperNavigation::getInternalNavigation(); ?>
    <!-- Media Header -->
    <div class="media-header">
      <?php if ($this->params->get('item_meta_title') != 'hide') :?>
        <h2 class="media-group-title"><?php echo $this->escape($this->group->title); ?></h2>
      <?php endif; ?> 
      <!-- View Type -->
      <ul class="media-category-ls">
        <?php if ($this->params->get('groupitem_member_count') != 'hide') :?><li>(<?php echo (int) $this->group->nummembers; ?>) <?php echo JText::_('COM_HWDMS_MEMBERS'); ?></li><?php endif; ?>
        <?php if ($this->params->get('groupitem_media_count') != 'hide') :?><li>(<?php echo (int) $this->group->nummedia; ?>) <?php echo JText::_('COM_HWDMS_MEDIA'); ?></li><?php endif; ?>
        <?php if ($this->params->get('groupitem_join_button') != 'hide') :?>
        <?php if ($user->id && $this->group->ismember) : ?>
          <li><a title="<?php echo JText::_('COM_HWDMS_LEAVE_GROUP'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=group.leave&id=' . $this->group->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_LEAVE_GROUP'); ?></a></li>
	<?php elseif ($user->id && !$this->group->ismember): ?>
          <li><a title="<?php echo JText::_('COM_HWDMS_JOIN_GROUP'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=group.join&id=' . $this->group->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_JOIN_GROUP'); ?></a></li>
	<?php endif; ?>
        <?php endif; ?>
        <?php if ($canAdd) :?>
        <li><a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=upload&tmpl=component&group_id='.(int)$this->group->id); ?>" class="ls-add modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}" title="<?php echo JText::_('COM_HWDMS_ADD_MEDIA'); ?>"><?php echo JText::_('COM_HWDMS_ADD_MEDIA'); ?></a> </li>
        <?php endif; ?>
      </ul>
      <div class="clear"></div>
      <!-- Description -->
      <div class="media-album-description">
        <!-- Thumbnail Image -->
        <?php if ($this->params->get('item_meta_thumbnail') != 'hide') :?>
        <div class="media-item">
          <?php if ($canEdit || $canDelete): ?>
          <!-- Actions -->
          <ul class="media-nav">
            <li><a href="#" class="pagenav-manage"><?php echo JText::_('COM_HWDMS_MANAGE'); ?> </a>
              <ul class="media-subnav">
                <?php if ($canEdit) : ?>
                <li><?php echo JHtml::_('hwdicon.edit', 'group', $this->group, $this->params); ?></li>
                <?php endif; ?>
                <?php if ($canEditState) : ?>
                <?php if ($this->group->published != '1') : ?>
                <li><?php echo JHtml::_('hwdicon.publish', 'group', $this->group, $this->params); ?></li>
                <?php else : ?>
                <li><?php echo JHtml::_('hwdicon.unpublish', 'group', $this->group, $this->params); ?></li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($canDelete) : ?>
                <li><?php echo JHtml::_('hwdicon.delete', 'group', $this->group, $this->params); ?></li>
                <?php endif; ?>
              </ul>
            </li>
          </ul>
          <?php endif; ?>
          <!-- Media Type -->
          <?php if ($this->params->get('item_meta_type_icon') != 'hide') :?>
          <div class="media-item-format-3">
             <img src="<?php echo JHtml::_('hwdicon.overlay', 3); ?>" alt="Group" />
          </div>
          <?php endif; ?>
          <img src="<?php echo JRoute::_(hwdMediaShareDownloads::thumbnail($this->group, 3)); ?>" border="0" alt="<?php echo $this->escape($this->group->title); ?>" style="width:120px;" />
        </div>
        <?php endif; ?>
        <?php if ($this->params->get('item_meta_author') != 'hide' || $this->params->get('item_meta_created') != 'hide' || $this->params->get('item_meta_hits') != 'hide' || $this->params->get('item_meta_likes') != 'hide' || $this->params->get('item_meta_report') != 'hide') : ?>
        <dl class="article-info">
          <dt class="article-info-term"><?php echo JText::_('COM_HWDMS_DETAILS'); ?> </dt>
          <?php if ($this->params->get('item_meta_author') != 'hide') :?>
            <dd class="media-info-createdby"> <?php echo JText::sprintf('COM_HWDMS_CREATED_BY', '<a href="'.JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->group->created_user_id)).'">'.htmlspecialchars($this->group->author, ENT_COMPAT, 'UTF-8').'</a>'); ?></dd>
          <?php endif; ?>
          <?php if ($this->params->get('item_meta_created') != 'hide') :?>
            <dd class="media-info-created"> <?php echo JText::sprintf('COM_HWDMS_CREATED_ON', JHtml::_('date', $this->group->created, $this->params->get('list_date_format'))); ?></dd>
          <?php endif; ?>
          <?php if ($this->params->get('item_meta_hits') != 'hide') :?>
            <dd class="media-info-hits"> <?php echo JText::_('COM_HWDMS_VIEWS'); ?> (<?php echo (int) $this->group->hits; ?>)</dd>
          <?php endif; ?> 
          <?php if ($this->params->get('item_meta_likes') != 'hide') :?>
            <dd class="media-info-like"> <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=group.like&id=' . $this->group->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_LIKE'); ?></a> (<?php echo $this->escape($this->group->likes); ?>) <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=group.dislike&id=' . $this->group->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_DISLIKE'); ?></a> (<?php echo $this->escape($this->group->dislikes); ?>) </dd>
          <?php endif; ?> 
          <?php if ($this->params->get('item_meta_report') != 'hide') :?>
            <dd class="media-info-report"> <a title="<?php echo JText::_('COM_HWDMS_REPORT'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=groupform.report&id=' . $this->group->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"><?php echo JText::_('COM_HWDMS_REPORT'); ?> </a> </dd>
          <?php endif; ?> 
        </dl>
        <?php endif; ?>  
        <!-- Custom fields -->
        <dl class="media-article-info">
        <?php foreach ($this->group->customfields['fields'] as $group => $groupFields) : ?>
          <dt class="media-article-info-term"><?php echo JText::_( $group ); ?></dt>
          <?php foreach ($groupFields as $field) :
          $field	= JArrayHelper::toObject ( $field );
          $field->value = $this->escape( $field->value );
          ?>
            <dd class="media-createdby" title="" class="hasTip" for="jform_<?php echo $field->id;?>" id="jform_<?php echo $field->id;?>-lbl">
              <?php echo JText::_( $field->name );?> <?php echo $this->escape($field->value); ?>
            </dd>
          <?php endforeach; ?>
        <?php endforeach; ?>
        </dl>
        <?php if ($this->params->get('item_meta_description') != 'hide') :?>
        <div class="clear"></div> 
        <?php echo JHtml::_('content.prepare', $this->group->description); ?>
        <?php endif; ?> 
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="media-group-container">
      <?php if ($this->params->get('groupitem_media_map') != 'hide') :?>
      <div class="items-leading">
        <div class="leading-0">
          <h2><?php echo JText::_('COM_HWDMS_GROUP_MEDIA_MAP'); ?></h2>
          <div class="media-group-map" style="height:300px;">
            <?php echo ($this->group->map); ?>
            <div class="clear"></div>
          </div>
          <p class="readmore">
            <a class="modal" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=group&id='.$this->group->id.'&layout=map&tmpl=component'); ?>" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}">
              <?php echo JText::_('COM_HWDMS_ENLARGE_MAP'); ?>
            </a>
          </p>
        </div>
      </div>
      <?php endif; ?>      
      <div class="items-row cols-2 row-0">
        <?php if ($this->params->get('groupitem_group_activity') != 'hide') :?>  
        <div class="item column-1">
    <?php if ($this->params->get('mediaitem_activity') != 'hide') : ?>
    <form action="<?php echo JRoute::_('index.php?option=com_hwdmediashare'); ?>" method="post">
    <!-- Comments -->
    <div class="media-comments">
    <h3><?php echo JText::_('COM_HWDMS_GROUP_ACTIVITY'); ?></h3>
    <?php if ($this->params->get('commenting') == 1) : ?>
    <div class="categories-list">
      <ul class="category-module">
        <li class="">
          <div class="category-desc">
            <fieldset>
              <!--<legend><strong><?php echo JText::_('COM_HWDMS_WRITE_A_COMMENT'); ?></strong></legend>-->
              <a class="image-left" href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($this->group->created_user_id)); ?>"><img border="0" src="<?php echo JRoute::_($this->utilities->getAvatar(JFactory::getUser($this->group->created_user_id))); ?>" class="avatar-small" /></a>
              <div><textarea class="required" rows="10" id="jform_comment" name="jform[comment]" required="required" style="white-space:nowrap; margin-bottom:10px; height: 50px;"></textarea></div>
              <div class="clear"></div>
              <?php echo $this->getRecaptcha(); ?>
              <input class="button" type="submit" value="<?php echo JText::_('COM_HWDMS_ADD_COMMENT'); ?>" />
              <input type="hidden" name="task" value="activity.comment" />
              <input type="hidden" name="id" value="<?php echo $this->group->id; ?>" />
              <input type="hidden" name="element_type" value="3" />
              <input type="hidden" name="return" value="<?php echo $this->return; ?>" />
            </fieldset>
            <div class="clear"></div>
          </div>
        </li>
      </ul>
    </div>
    <?php endif; ?>
    <div class="categories-list"> <?php echo $this->getActivities($this->group->activities); ?> </div>
    <p class="readmore">
      <a class="modal" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=activities&element_type=3&element_id='.$this->group->id.'&tmpl=component'); ?>" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL_ACTIVITY'); ?>
      </a>
    </p>
    </div>
    </form>
    <?php endif; ?>
    <?php if ($this->params->get('commenting') != 1) : ?>
    <?php echo $this->getComments($this->group); ?>
    <?php endif; ?>
    <div class="clear"></div>
          <div class="item-separator"></div>
        </div>
        <?php endif; ?> 
        <div class="item column-2">
          <?php echo JHtml::_('sliders.start', 'media-group-slider', array('useCookie'=>true)); ?>
            <?php if ($this->params->get('groupitem_group_members') != 'hide') :?>  
            <?php echo JHtml::_('sliders.panel', JText::_('COM_HWDMS_MEMBERS'), 'members'); ?>
              <div class="media-gallery-view">
                <?php if (count($this->members) == 0) : ?>
                <?php echo JText::_('COM_HWDMS_NO_MEMBERS'); ?>
                <?php endif; ?>
                <?php foreach ($this->members as $id => &$item) : ?>
                    <a class="image-left hasTip" title="<?php echo $this->escape(JHtmlString::truncate($item->title, $this->params->get('list_title_truncate'))); ?>::" href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($item->id)); ?>"><img width="75" height="75" border="0" src="<?php echo JRoute::_(hwdMediaShareDownloads::thumbnail($item, 5)); ?>" /></a>
                <?php endforeach; ?>
              </div>
              <div class="clear"></div>
              <p class="readmore">
                <a class="modal" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=group&id='.$this->group->id.'&layout=members&tmpl=component'); ?>" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
                  <?php echo JText::_('COM_HWDMS_VIEW_ALL_MEMBERS'); ?>
                </a>
              </p>
            <?php endif; ?>              
            <?php if ($this->params->get('groupitem_group_media') != 'hide') :?>  
            <?php  echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_MEDIA'), 'media'); ?>
              <?php echo $this->loadTemplate('gallery'); ?>
              <p class="readmore">
                <a class="modal" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=group&id='.$this->group->id.'&layout=media&tmpl=component'); ?>" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
                  <?php echo JText::_('COM_HWDMS_VIEW_ALL_MEDIA'); ?>
                </a>
              </p>
            <?php endif; ?>
          <?php echo JHtml::_('sliders.end'); ?>
	  <div class="item-separator"></div>
	</div>
      <span class="row-separator"></span>
      </div>
    </div>
  </div>
