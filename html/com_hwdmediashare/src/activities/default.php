<?php
/**
 * @version    SVN $Id: default.php 579 2012-10-16 10:17:11Z dhorsfall $
 * @package    hwdMediaShare
 * @copyright  Copyright (C) 2012 Highwood Design Limited. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Dave Horsfall
 * @since      20-Jan-2012 09:23:40
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();
JHtml::_('behavior.tooltip');
JHtml::_('behavior.modal');

?>
<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
  <div id="hwd-container"><a name="top" id="top"></a>
    <!-- Media Navigation -->
    <div class="categories-list"> <?php echo $this->getActivities($this->items); ?> </div>
    <!-- Pagination -->
    <div class="pagination"> <?php echo $this->pagination->getPagesLinks(); ?> </div>
  </div>
</form>