<?php
/**
 * @version    SVN $Id: default.php 492 2012-08-24 15:11:58Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2011 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      16-Nov-2011 19:45:01
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$user = JFactory::getUser();
$canEdit = ($user->authorise('core.edit', 'com_hwdmediashare.user.'.$this->channel->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.user.'.$this->channel->id) && ($this->channel->id == $user->id)));
$canEditState = $user->authorise('core.edit.state', 'com_hwdmediashare.user.'.$this->channel->id);
$canDelete = ($user->authorise('core.delete', 'com_hwdmediashare.user.'.$this->channel->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.user.'.$this->channel->id) && ($this->channel->id == $user->id)));

JHtml::_('behavior.modal');
JHtml::_('behavior.framework', true);

?>
<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
  <div id="hwd-container"> <a name="top" id="top"></a>
    <!-- Media Navigation -->
    <?php echo hwdMediaShareHelperNavigation::getInternalNavigation(); ?>
    <!-- Media Header -->
    <div class="media-header">
      <?php if ($this->params->get('item_meta_title') != 'hide') :?>
        <h2 class="media-user-title"><?php echo $this->escape($this->channel->title); ?></h2>
      <?php endif; ?> 
      <!-- View Type -->
      <ul class="media-category-ls">
        <?php if ($this->params->get('list_details_button') != 'hide') :?><li><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getSelfRoute('details')); ?>" class="ls-detail" title="<?php echo JText::_('COM_HWDMS_DETAILS'); ?>"><?php echo JText::_('COM_HWDMS_DETAILS'); ?></a></li><?php endif; ?>
        <?php if ($this->params->get('list_list_button') != 'hide') :?><li><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getSelfRoute('list')); ?>" class="ls-list" title="<?php echo JText::_('COM_HWDMS_LIST'); ?>"><?php echo JText::_('COM_HWDMS_LIST'); ?></a></li><?php endif; ?>
      </ul>
      <div class="clear"></div>
      <!-- Description -->
      <div class="media-user-description">
        <!-- Thumbnail Image -->
        <div class="media-item">
          <?php if ($canEdit || $canDelete): ?>
          <!-- Actions -->
          <ul class="media-nav">
            <li><a href="#" class="pagenav-manage"><?php echo JText::_('COM_HWDMS_MANAGE'); ?> </a>
              <ul class="media-subnav">
                <?php if ($canEdit) : ?>
                <li><?php echo JHtml::_('hwdicon.edit', 'user', $this->channel, $this->params); ?></li>
                <?php endif; ?>
                <?php if ($canEditState) : ?>
                <?php if ($this->channel->published != '1') : ?>
                <li><?php echo JHtml::_('hwdicon.publish', 'user', $this->channel, $this->params); ?></li>
                <?php else : ?>
                <li><?php echo JHtml::_('hwdicon.unpublish', 'user', $this->channel, $this->params); ?></li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($canDelete) : ?>
                <li><?php echo JHtml::_('hwdicon.delete', 'user', $this->channel, $this->params); ?></li>
                <?php endif; ?>
              </ul>
            </li>
          </ul>
          <?php endif; ?>
          <!-- Media Type -->
          <?php if ($this->params->get('item_meta_thumbnail') != 'hide') :?>
          <?php if ($this->params->get('item_meta_type_icon') != 'hide') :?>
          <div class="media-item-format-5">
             <img src="<?php echo JHtml::_('hwdicon.overlay', 5); ?>" alt="<?php echo JText::_('COM_HWDMS_USER'); ?>" />
          </div>
          <?php endif; ?>
          <img src="<?php echo JRoute::_(hwdMediaShareDownloads::thumbnail($this->channel, 5)); ?>" border="0" alt="<?php echo $this->escape($this->channel->title); ?>" style="width:120px;" />
          <?php endif; ?>
        </div>
        <?php if ($this->params->get('item_meta_media_count') != 'hide' || $this->params->get('item_meta_created') != 'hide' || $this->params->get('item_meta_hits') != 'hide' || $this->params->get('item_meta_likes') != 'hide' || $this->params->get('item_meta_report') != 'hide') : ?>
        <dl class="article-info">
          <dt class="article-info-term"><?php echo JText::_('COM_HWDMS_DETAILS'); ?> </dt>
          <?php if ($this->params->get('item_meta_media_count') != 'hide') :?>
            <dd class="media-info-count"><?php echo JText::_('COM_HWDMS_MEDIA'); ?> (<?php echo (int) $this->channel->nummedia; ?>)</dd>
          <?php endif; ?>
          <?php if ($this->params->get('item_meta_created') != 'hide') :?>
            <dd class="media-info-created"> <?php echo JText::sprintf('COM_HWDMS_CREATED_ON', JHtml::_('date', $this->channel->created, $this->params->get('list_date_format'))); ?></dd>
          <?php endif; ?>            
          <?php if ($this->params->get('item_meta_hits') != 'hide') :?>
            <dd class="media-info-hits"><?php echo JText::_('COM_HWDMS_VIEWS'); ?> (<?php echo (int) $this->channel->hits; ?>)</dd>
          <?php endif; ?>           
          <?php if ($this->params->get('item_meta_likes') != 'hide') :?>
            <dd class="media-info-like"> <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=user.like&id=' . $this->channel->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_LIKE'); ?></a> (<?php echo $this->escape($this->channel->likes); ?>) <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=user.dislike&id=' . $this->channel->id . '&return=' . $this->return . '&tmpl=component'); ?>"><?php echo JText::_('COM_HWDMS_DISLIKE'); ?></a> (<?php echo $this->escape($this->channel->dislikes); ?>) </dd>
          <?php endif; ?>   
          <?php if ($this->params->get('item_meta_report') != 'hide') :?>
            <dd class="media-info-report"> <a title="<?php echo JText::_('COM_HWDMS_REPORT'); ?>" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&task=userform.report&id=' . $this->channel->id . '&return=' . $this->return . '&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize(); ?>}}"><?php echo JText::_('COM_HWDMS_REPORT'); ?> </a> </dd>
          <?php endif; ?>  
        </dl>
        <?php endif; ?>  
        <!-- Custom fields -->
        <dl class="media-article-info">
        <?php foreach ($this->channel->customfields['fields'] as $group => $groupFields) : ?>
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
        <?php echo JHtml::_('content.prepare', $this->channel->description); ?>
        <?php endif; ?> 
        <div class="clear"></div> 
      </div>
      <div class="clear"></div>
    </div>
    <?php echo JHtml::_('sliders.start', 'media-user-slider', array('useCookie'=>true)); ?>
    <?php if (count($this->media)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_MEDIA'), 'media'); ?>
        <?php echo $this->loadTemplate('media_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=media&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->favourites)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_FAVOURITES'), 'favourites'); ?>
        <?php echo $this->loadTemplate('favourites_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=favourites&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->groups)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_GROUPS'), 'groups'); ?>
        <?php echo $this->loadTemplate('groups_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=groups&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->playlists)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_PLAYLISTS'), 'playlists'); ?>
        <?php echo $this->loadTemplate('playlists_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=playlists&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->albums)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_ALBUMS'), 'albums'); ?>
        <?php echo $this->loadTemplate('albums_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=albums&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->activities)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_ACTIVITY'), 'activities'); ?>
        <?php echo $this->loadTemplate('activities'); ?>
        <p class="readmore">
        <a class="modal" href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=activities&user_id='.$this->channel->id.'&tmpl=component'); ?>" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php if (count($this->subscribers)) : ?>     
    <?php echo JHtml::_('sliders.panel',JText::_('COM_HWDMS_SUBSCRIBERS'), 'subscribers'); ?>
        <?php echo $this->loadTemplate('subscribers_'.$this->display); ?>
        <p class="readmore">
        <a href="<?php echo JRoute::_('index.php?option=com_hwdmediashare&view=user&id=' . $this->channel->id . '&layout=subscribers&display='.$this->display.'&tmpl=component'); ?>" class="modal" rel="{handler: 'iframe', size: {<?php echo $this->utilities->modalSize('large'); ?>}}">
        <?php echo JText::_('COM_HWDMS_VIEW_ALL'); ?>
        </a>
        </p>
    <?php endif; ?>
    <?php echo JHtml::_('sliders.end'); ?>
  </div>
</form>