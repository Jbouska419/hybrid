<?php
/**
 * @version    SVN $Id: default_list.php 970 2013-01-30 09:10:33Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2012 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      18-Jan-2012 09:35:59
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$user = JFactory::getUser();

$row=0;
$counter=0;
$leadingcount=0;
$introcount=0;
?>
<div class="media-list-view">
  <table class="category">
    <thead>
      <tr>
          <th width="1%"> <input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
          </th>
          <th> <?php echo JHtml::_('grid.sort',  JText::_('COM_HWDMS_MEMBER'), 'a.title', $listDirn, $listOrder); ?>
          </th>
          <th width="20"> <?php echo JHtml::_('grid.sort',  JText::_('COM_HWDMS_LINKED'), 'connection', $listDirn, $listOrder); ?>
          </th>          
          <th width="20"> <?php echo JText::_('COM_HWDMS_ID'); ?>
          </th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($this->items as $id => &$item) : ?>
      <tr class="cat-list-row<?php echo ($counter % 2);?>">
         <td><?php echo JHtml::_('grid.id', $id, $item->id); ?></td>
         <td><a href="<?php echo JRoute::_(hwdMediaShareHelperRoute::getUserRoute($item->id)); ?>" target="_top"> <?php echo $this->escape($item->username); ?> </a> </td>
         <td><?php echo $this->getConnection($item, $id); ?></td>
         <td><?php echo $item->id; ?></td>
      </tr>
      <?php $counter++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
