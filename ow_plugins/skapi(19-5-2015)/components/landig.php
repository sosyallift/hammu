<?php

/**
 * This software is intended for use with Oxwall Free Community Software http://www.oxwall.org/ and is
 * licensed under The BSD license.

 * ---
 * Copyright (c) 2011, Oxwall Foundation
 * All rights reserved.

 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the
 * following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice, this list of conditions and
 *  the following disclaimer.
 *
 *  - Redistributions in binary form must reproduce the above copyright notice, this list of conditions and
 *  the following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 *  - Neither the name of the Oxwall Foundation nor the names of its contributors may be used to endorse or promote products
 *  derived from this software without specific prior written permission.

 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Notification
 *
 * @author Sergey Kambalin <greyexpert@gmail.com>
 * @package ow_plugins.notifications.components
 * @since 1.0
 */
class SKAPI_CMP_Landing extends OW_Component {

    public function __construct() {
        parent::__construct();

        //$this->userId = $userId;
    }

//    public function addItem($notification) {
////        $this->items[] = $this->processDataInterface($notification);
////        $this->unsubscribeAction = count($this->items) == 1 ? $notification['action'] : 'all';
//    }
//    private function getUnsubscribeUrl($all = false) {
//        return OW::getRouter()->urlForRoute('notifications-unsubscribe', array(
//                    'code' => $this->unsubscribeCode,
//                    'action' => $all ? "all" : $this->unsubscribeAction
//        ));
//    }

    public function onBeforeRender() {
        parent::onBeforeRender();

        //$items = $this->itemsPrepare();
//        $this->assign('items', $items);
//        $this->assign('userName', BOL_UserService::getInstance()->getDisplayName($this->userId));
//        $this->assign('unsubscribeUrl', $this->getUnsubscribeUrl());
//        $this->assign('unsubscribeAllUrl', $this->getUnsubscribeUrl(true));
//
//        $single = $this->unsubscribeAction != 'all';
//        $this->assign('single', $single);
//
//        $this->assign('settingsUrl', OW::getRouter()->urlForRoute('notifications-settings'));
        OW::getConfig()->getValue('skapi', 'store_period');

        $this->assign('html', OW::getConfig()->getValue('skapi', 'store_period'));
    }

//    public function getSubject() {
//        if (count($this->items) == 1) {
//            $item = reset($this->items);
//
//            return strip_tags($item['string']);
//        }
//
//        return OW::getLanguage()->text('notifications', 'email_subject');
//    }

    public function getHtml() {
        $template = OW::getPluginManager()->getPlugin('ocs_guests2')->getCmpViewDir() . 'landing_html.html';
        $this->setTemplate($template);

        return parent::render();
    }

//    public function getTxt() {
//        $template = OW::getPluginManager()->getPlugin('notifications')->getCmpViewDir() . 'notification_txt.html';
//        $this->setTemplate($template);
//
//        $this->assign('nl', '%%%nl%%%');
//        $this->assign('tab', '%%%tab%%%');
//        $this->assign('space', '%%%space%%%');
//
//        $content = parent::render();
//        $search = array('%%%nl%%%', '%%%tab%%%', '%%%space%%%');
//        $replace = array("\n", '    ', ' ');
//
//        return str_replace($search, $replace, $content);
//    }
}

