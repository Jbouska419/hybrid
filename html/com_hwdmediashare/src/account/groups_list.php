<?php
/**
 * @version    SVN $Id: groups_list.php 964 2013-01-30 09:08:44Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2012 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      18-Jan-2012 17:45:23
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$user = JFactory::getUser();

JHtml::_('behavior.tooltip');

$counter=0;
?>
<div class="media-list-view">
  <table class="category">
    <thead>
      <tr>
        <th width="20"> <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /> </th>
        <?php if ($this->params->get('list_meta_thumbnail') != 'hide') :?>
          <th width="20"> <?php echo JText::_( 'COM_HWDMS_THUMBNAIL' ); ?>
          </th>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_title') != 'hide') :?>
          <th class="list-title" id="tableOrdering1"> <?php  echo JHtml::_('grid.sort', 'COM_HWDMS_TITLE', 'a.title', $listDirn, $listOrder) ; ?>
          </th>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_created') != 'hide') :?>
          <th class="list-date" id="tableOrdering2"> <?php  echo JHtml::_('grid.sort', 'COM_HWDMS_CREATED', 'a.created', $listDirn, $listOrder) ; ?>
          </th>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_author') != 'hide') :?>
          <th class="list-author" id="tableOrdering3"> <?php  echo JHtml::_('grid.sort', 'JAUTHOR', 'author', $listDirn, $listOrder) ; ?>
          </th>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_hits') != 'hide') :?>
          <th class="list-hits" id="tableOrdering4"> <?php  echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder) ; ?>
          </th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($this->items as $id => &$item) :
    $item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
    $canEdit = ($user->authorise('core.edit', 'com_hwdmediashare.group.'.$item->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.group.'.$item->id) && ($item->created_user_id == $user->id)));
    $canEditState = $user->authorise('core.edit.state', 'com_hwdmediashare.group.'.$item->id);
    $canDelete = ($user->authorise('core.delete', 'com_hwdmediashare.group.'.$item->id) || ($user->authorise('core.edit.own', 'com_hwdmediashare.group.'.$item->id) && ($item->created_user_id == $user->id)));
    ?>
      <tr class="<?php echo ($item->published != '1' ? 'system-unpublished ' : false); ?>cat-list-row<?php echo ($counter % 2);?>">
        <td><?php echo JHtml::_('grid.id', $id, $item->id); ?></td>
        <?php if ($this->params->get('list_meta_thumbnail') != 'hide') :?>
          <td><div class="media-item">
          <?php if ($this->params->get('list_meta_type_icon') != 'hide') :?>
          <div class="media-item-format-3">
             <img src="<?php echo JHtml::_('hwdicon.overlay', '3', $item); ?>" alt="<?php echo JText::_('COM_HWDMS_GROUP'); ?>" />
          </div>
          <?php endif; ?>
          <?php if ($this->params->get('list_link_thumbnails') == 1) :?><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getGroupRoute($item->slug)); ?>"><?php endif; ?>
             <img src="<?php echo JRoute::_(hwdMediaShareDownloads::thumbnail($item, 3)); ?>" border="0" alt="<?php echo $this->escape($item->title); ?>" style="max-width:100px;" class="<?php echo ($this->params->get('list_tooltip_location') > '2' ? 'hasTip' : ''); ?>" title="<?php echo $this->escape($item->title); ?>::<?php echo ($this->params->get('list_tooltip_contents') != '0' ? $this->escape(JHtmlString::truncate($item->description, $this->params->get('list_desc_truncate'), true, false)) : ''); ?>" />
          <?php if ($this->params->get('list_link_thumbnails') == 1) :?></a><?php endif; ?>
          </div></td>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_title') != 'hide') :?>
          <td class="list-title"><?php if ($canEdit || $canDelete): ?>
          <ul class="media-nav">
            <li><a href="#" class="pagenav-manage"><?php echo JText::_('COM_HWDMS_MANAGE'); ?> </a>
              <ul class="media-subnav">
                <?php if ($canEdit) : ?>
                <li><?php echo JHtml::_('hwdicon.edit', 'group', $item, $this->params); ?></li>
                <?php endif; ?>
                <?php if ($canEditState) : ?>
                <?php if ($item->published != '1') : ?>
                <li><?php echo JHtml::_('hwdicon.publish', 'group', $item, $this->params); ?></li>
                <?php else : ?>
                <li><?php echo JHtml::_('hwdicon.unpublish', 'group', $item, $this->params); ?></li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($canDelete) : ?>
                <li><?php echo JHtml::_('hwdicon.delete', 'group', $item, $this->params); ?></li>
                <?php endif; ?>
              </ul>
            </li>
          </ul>
          <?php endif; ?>
            <p class="<?php echo ($this->params->get('list_tooltip_location') > '1' ? 'hasTip' : ''); ?>" title="<?php echo $this->escape($item->title); ?>::<?php echo ($this->params->get('list_tooltip_contents') != '0' ? $this->escape(JHtmlString::truncate($item->description, $this->params->get('list_desc_truncate'), true, false)) : ''); ?>">
            <?php if ($this->params->get('list_link_titles') == 1) :?><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getGroupRoute($item->slug)); ?>"><?php endif; ?>
              <?php echo $this->escape($item->title); ?>
            <?php if ($this->params->get('list_link_titles') == 1) :?></a><?php endif; ?>
            </p>
            <?php if ($this->params->get('list_meta_description') != 'hide') :?>
              <div><?php echo $this->escape(JHtmlString::truncate($item->description, $this->params->get('list_desc_truncate'), true, false)); ?></div>
            <?php endif; ?></td>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_created') != 'hide') :?>
          <td class="list-date"><?php echo JHtml::_('date',$item->created, JText::_('DATE_FORMAT_LC2')); ?></td>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_author') != 'hide') :?>
          <td class="list-author"><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($item->created_user_id)); ?>"><?php echo $this->escape($item->author); ?></a></td>
        <?php endif; ?>
        <?php if ($this->params->get('list_meta_hits') != 'hide') :?>
          <td class="list-hits"><?php echo (int) $item->hits; ?></td>
        <?php endif; ?>
      </tr>
      <?php $counter++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>