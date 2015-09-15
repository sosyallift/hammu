<?php
/**
 * Copyright (c) 2014, Skalfa LLC
 * All rights reserved.
 *
 * ATTENTION: This commercial software is intended for exclusive use with SkaDate Dating Software (http://www.skadate.com) and is licensed under SkaDate Exclusive License by Skalfa LLC.
 *
 * Full text of this license can be found at http://www.skadate.com/sel.pdf
 */

$widget = BOL_ComponentAdminService::getInstance()->addWidget('HOTLIST_CMP_IndexWidget', false);

$placeWidget = BOL_ComponentAdminService::getInstance()->addWidgetToPlace($widget, BOL_ComponentAdminService::PLACE_DASHBOARD);

BOL_ComponentAdminService::getInstance()->addWidgetToPosition($placeWidget, BOL_ComponentAdminService::SECTION_RIGHT, 0 );

require_once dirname(__FILE__) . DS .  'classes' . DS . 'credits.php';
$credits = new HOTLIST_CLASS_Credits();
$credits->triggerCreditActionsAdd();