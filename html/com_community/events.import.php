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
<div class="cLayout cEvents-Import">
    <form class="cForm" name="jsforms-events-import" action="<?php echo CRoute::getURI(); ?>" method="post"
          enctype="multipart/form-data">
        <div class="ctitle">
            <h2><?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT_ICAL_DESCRIPTION'); ?></h2>
        </div>
        <ul class="cFormList cResetList iCalOptions">
            <li class="jsiCalSel">
                <label for="upload">
                    <input class="radio" type="radio" id="upload" name="type" checked="checked"
                           onclick="joms.events.switchImport('file');"/>
                    <?php echo JText::_('COM_COMMUNITY_EVENTS_INPORT_LOCAL'); ?>
                </label>
            </li>
            <li class="jsiCalSel">
                <label for="link">
                    <input type="radio" id="link" name="type" onclick="joms.events.switchImport('url');" class="radio"/>
                    <?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT_EXTERNAL'); ?>
                </label>
            </li>
            <li class="has-seperator	" id="event-import-file">
                <input type="file" class="input file" name="file" style="width: 320px;"/>
                <span class="form-helper"><?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT_ERROR'); ?></span>
            </li>
            <li class="has-seperator" id="event-import-url" style="display: none;">
                <input type="text" class="input text" name="url" style="width: 320px;"/>
                <span class="form-helper"><?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT_ERROR'); ?></span>
            </li>
            <li class="has-seperator">
                <input type="submit" value="<?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT'); ?>"
                       class="btn btn-primary"/>
                <input type="hidden" value="file" name="type" id="import-type"/>
            </li>
        </ul>
    </form>
    <?php if ($events) { ?>
        <form action="<?php echo $saveimportlink; ?>" method="post">
            <div class="ctitle" style="padding-top:16px !important;margin-bottom:16px;">
                <?php echo JText::_('COM_COMMUNITY_EVENTS_EXPORTED'); ?>
            </div>
            <p><?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT_SELECT'); ?></p>
            <ul class="cResetList joms-event-import-listing">
                <?php
                $i = 1;
                foreach ($events as $event) {
                    ?>
                    <li>
                        <ul class=" cFormList cFormHorizontal cResetList">
                            <li>
                                <div class="form-header">
                                    <label class="label-checkbox">
                                        <input type="checkbox" name="events[]" id="event-<?php echo $i; ?>"
                                               class="input checkbox" value="1">
                                        <span><?php echo $event->getTitle(); ?></span>
                                    </label
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_PHOTOS_ALBUM_DESC'); ?>
                                </label>

                                <div class="form-field">
                                    <?php if ($event->getDescription()) { ?>
                                        <p><?php echo $event->getDescription(); ?></p>
                                    <?php } else { ?>
                                        <p><?php echo JText::_('COM_COMMUNITY_EVENTS_DESCRIPTION_ERR0R'); ?></p>
                                    <?php } ?>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_START_TIME'); ?>
                                </label>

                                <div class="form-field">
                                    <?php echo CTimeHelper::getFormattedUTC($event->getStartDate(), $offsetValue); ?>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_END_TIME'); ?>
                                </label>

                                <div class="form-field">
                                    <?php echo CTimeHelper::getFormattedUTC($event->getEndDate(), $offsetValue); ?>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_TIMEZONE'); ?>
                                </label>

                                <div class="form-field">
                                    <?php

                                    $time = new DateTime('now', new DateTimeZone($offset));
                                    $time = (int)$time->format('P');
                                    ?>

                                    <input name="event-<?php echo $i; ?>-offset-text" type="text"
                                           value="<?php echo $offset; ?>" disabled="disabled" class="disable">
                                    <input name="event-<?php echo $i; ?>-offset" type="hidden"
                                           value="<?php echo $time; ?>">
                                </div>
                            </li>


                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_LOCATION'); ?>
                                </label>

                                <div class="form-field">
                                    <?php echo ($event->getLocation() != '') ? $event->getLocation() : JText::_(
                                        'COM_COMMUNITY_EVENTS_LOCATION_NOT_AVAILABLE'
                                    ); ?>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_CATEGORY'); ?>
                                </label>

                                <div class="form-field">
                                    <select name="event-<?php echo $i; ?>-catid" id="event-<?php echo $i; ?>-catid"
                                            class="required input select">
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->id; ?>"><?php echo JText::_(
                                                    $this->escape($category->name)
                                                ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_GUEST_INVITE'); ?>
                                </label>

                                <div class="form-field">
                                    <input type="radio" class="input radio" name="event-<?php echo $i; ?>-invite"
                                           id="event-<?php echo $i; ?>-invite-allowed" value="1" checked="checked"/>
                                    <span for="event-<?php echo $i; ?>-invite-allowed"><?php echo JText::_(
                                            'COM_COMMUNITY_YES'
                                        ); ?></span>
                                    <input type="radio" class="input radio" name="event-<?php echo $i; ?>-invite"
                                           id="event-<?php echo $i; ?>-invite-disallowed" value="0"/>
                                    <span for="event-<?php echo $i; ?>-invite-disallowed"><?php echo JText::_(
                                            'COM_COMMUNITY_NO'
                                        ); ?></span>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_TYPE'); ?>
                                </label>

                                <div class="form-field">
                                    <input type="radio" class="input radio" name="event-<?php echo $i; ?>-permission"
                                           id="event-<?php echo $i; ?>-permission-open" value="0" checked="checked"/>
                                    <span for="event-<?php echo $i; ?>-permission-open"><?php echo JText::_(
                                            'COM_COMMUNITY_EVENTS_OPEN_EVENT'
                                        ); ?></span>
                                    <input type="radio" class="input radio" name="event-<?php echo $i; ?>-permission"
                                           id="event-<?php echo $i; ?>-permission-private" value="1"/>
                                    <span for="event-<?php echo $i; ?>-permission-private"><?php echo JText::_(
                                            'COM_COMMUNITY_EVENTS_PRIVATE_EVENT'
                                        ); ?></span>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_NO_SEAT'); ?>
                                </label>

                                <div class="form-field">
                                    <input type="text" class="input text" name="event-<?php echo $i; ?>-ticket"
                                           id="event-<?php echo $i; ?>-ticket" value="0" size="10" maxlength="5"/>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_REPEAT'); ?>
                                </label>

                                <div class="form-field">
                                    <?php $repeat = $event->getRepeat(); ?>
                                    <select name="event-<?php echo $i; ?>-repeat" class="input select"
                                            id="event-<?php echo $i; ?>-repeat">
                                        <option value=""><?php echo JText::_(
                                                'COM_COMMUNITY_EVENTS_REPEAT_NONE'
                                            ); ?></option>
                                        <option
                                            value="daily" <?php echo $repeat == 'daily' ? 'selected' : ''; ?>><?php echo JText::_(
                                                'COM_COMMUNITY_EVENTS_REPEAT_DAILY'
                                            ); ?></option>
                                        <option
                                            value="weekly" <?php echo $repeat == 'weekly' ? 'selected' : ''; ?>><?php echo JText::_(
                                                'COM_COMMUNITY_EVENTS_REPEAT_WEEKLY'
                                            ); ?></option>
                                        <option
                                            value="monthly" <?php echo $repeat == 'monthly' ? 'selected' : ''; ?>><?php echo JText::_(
                                                'COM_COMMUNITY_EVENTS_REPEAT_MONTHLY'
                                            ); ?></option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_REPEAT_END'); ?>
                                </label>

                                <div class="form-field">
                                    <?php echo $event->getRepeatEnd(); ?>
                                </div>
                            </li>
                            <li>
                                <label for="" class="form-label">
                                    <?php echo JText::_('COM_COMMUNITY_EVENTS_REPEAT_LIMIT'); ?>
                                </label>

                                <div class="form-field">
                                    <input type="text" class="input text" name="event-<?php echo $i; ?>-limit"
                                           id="event-<?php echo $i; ?>-limit"
                                           value="<?php echo $event->getRepeatLimit(); ?>" size="10" maxlength="5"/>
                                </div>
                            </li>

                            <input name="event-<?php echo $i; ?>-startdate"
                                   value="<?php echo $event->getStartDate(); ?>" type="hidden"/>
                            <input name="event-<?php echo $i; ?>-enddate" value="<?php echo $event->getEndDate(); ?>"
                                   type="hidden"/>
                            <input name="event-<?php echo $i; ?>-title" value="<?php echo $event->getTitle(); ?>"
                                   type="hidden"/>
                            <input name="event-<?php echo $i; ?>-location"
                                   value="<?php echo $this->escape($event->getLocation()); ?>" type="hidden"/>
                            <input name="event-<?php echo $i; ?>-description"
                                   value="<?php echo $this->escape($event->getDescription()); ?>" type="hidden"/>
                            <input name="event-<?php echo $i; ?>-summary" value="<?php echo $event->getSummary(); ?>"
                                   type="hidden"/>
                            <input name="event-<?php echo $i; ?>-repeatend"
                                   value="<?php echo $event->getRepeatEnd(); ?>" type="hidden"/>

                        </ul>
                    </li>
                    <?php $i++;
                } ?>

            </ul>
            <div><input type="submit" value="<?php echo JText::_('COM_COMMUNITY_EVENTS_IMPORT'); ?>"
                        class="btn btn-primary"/></div>
        </form>
    <?php } ?>
</div>