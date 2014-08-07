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
$mood = $this->acts[0]->params->get('mood',NULL);
?>

<?php
if (count($photos) > 0) {
    $firstPhoto = $photos[0]; /* Always get first photo */
    if ($batchCount > 1) { /* Multi photos uploaded */
        if ($batchCount >= 5) {
            $batchCountSlice = 4; /* Get maximum 4 photos to display in sub */
            $firstPhoto = array_shift($photos); /* Extract first photo as primary */
            $photos = array_slice($photos, 0, $batchCountSlice);
        }
    }
    $photoInfo = $firstPhoto->getInfo();
    $photoSize = $photoInfo['size'];
    ?>
    <!-- Single photo uploaded -->
    <?php if ($batchCount == 1) { ?>

        <!-- Activity title -->
        <p><?php echo CStringHelper::getMood($this->acts[0]->title,$mood); ?></p>
        <!-- First photo -->
        <div class="joms-stream-single-photo <?php echo $photoSize; ?>">
            <a href="<?php echo $firstPhoto->getPhotoLink(); ?>" >
                <img src="<?php echo $firstPhoto->getImageURI(); ?>" alt="<?php echo $this->escape($firstPhoto->caption); ?>" />
            </a>
        </div>

    <?php } else if ($batchCount <= 4) { ?> <!-- Multi photos uploaded: But lower or equal 4 photos -->

        <!-- Activity title -->
        <p class="joms-stream-photo-caption"><?php echo CStringHelper::getMood($this->acts[0]->title,$mood); ?></p>
        <div class="row-fluid joms-stream-multi-photo">
            <?php foreach ($photos as $photo) { ?>
                <div class="span3">
                    <div class="joms-stream-single-photo">
                        <a href="<?php echo $photo->getPhotoLink(); ?>" >
                            <img alt="<?php echo $this->escape($photo->caption); ?>" src="<?php echo $photo->getThumbURI(); ?>" />
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } else { ?> <!-- More than 4 photos uploaded -->

        <p class="joms-stream-photo-caption"><?php echo CStringHelper::getMood($this->acts[0]->title,$mood); ?></p>
        <div class="joms-stream-single-photo">
            <div class="joms-stream-multi-photo-hero">
                <a href="<?php echo $firstPhoto->getPhotoLink(); ?>" >
                    <img src="<?php echo $firstPhoto->getImageURI(); ?>" alt="<?php echo $this->escape($firstPhoto->caption); ?>" />
                </a>
            </div>

            <div class="joms-stream-multi-photo">
                <div class="row-fluid">
                    <?php foreach ($photos as $key => $photo) { ?>
                        <div class="span3">
                            <a href="<?php echo $photo->getPhotoLink(); ?>" class="cPhoto-Thumb"><img alt="<?php echo $this->escape($photo->caption); ?>" src="<?php echo $photo->getThumbURI(); ?>" /></a>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php } ?>
    <?php } else { ?>

    <div class="cEmpty small joms-rounded">
        <?php echo JText::_('COM_COMMUNITY_PHOTO_REMOVED'); ?>
    </div>

<?php } ?>

<?php if ( $album->description ) { ?>
<div class="cStream-Quote">
   <?php echo JHTML::_('string.truncate', $album->description, $config->getInt('streamcontentlength') );?>
</div>
 <?php } ?>