<?php

/**
 * Copyright (c) 2012, Oxwall CandyStore
 * All rights reserved.

 * This software is intended for use with Oxwall Free Community Software http://www.oxwall.org/ and is
 * licensed under The BSD license.
 */

/**
 * Guests plugin administration action controller
 *
 * @author Oxwall CandyStore <plugins@oxcandystore.com>
 * @package ow.ow_plugins.ocs_guests.controllers
 * @since 1.3.1
 */
class SKAPI_CTRL_Admin extends ADMIN_CTRL_Abstract {

    private function getMenu() {
        $language = OW::getLanguage();
        $menuItems = array();

        $item = new BASE_MenuItem();
        $item->setLabel($language->text('skapi', 'general_settings'));
        $item->setUrl(OW::getRouter()->urlForRoute('skapi.admin'));
        $item->setKey('settings');
        $item->setIconClass('ow_ic_gear_wheel');
        $item->setOrder(0);

        array_push($menuItems, $item);

        $menu = new BASE_CMP_ContentMenu($menuItems);

        return $menu;
    }

    /**
     * Default action
     */
    public function index() {
        $lang = OW::getLanguage();

        $form = new FormConfig();
        $this->addForm($form);

        if (OW::getRequest()->isPost() && $form->isValid($_POST)) {

            $values = $form->getValues();
            if ($values['months'] > 12) {
                $values['months'] = 12;
            }

            OW::getConfig()->saveConfig('skapi', 'store_period', (int) $values['months']);

            OW::getFeedback()->info($lang->text('skapi', 'settings_updated'));
            $this->redirect();
        }

        $this->addComponent('menu', $this->getMenu());

        $form->getElement('months')->setValue(OW::getConfig()->getValue('skapi', 'store_period'));

        $logo = OW::getPluginManager()->getPlugin('skapi')->getStaticUrl() . 'img/oxwallcandystore-logo.jpg';
        $this->assign('logo', $logo);

        $this->setPageHeading($lang->text('skapi', 'page_heading_admin'));
        $this->setPageHeadingIconClass('ow_ic_gear_wheel');
    }

}

class FormConfig extends Form {

    public function __construct() {
        parent::__construct('config-form');

        $lang = OW::getLanguage();

        $months = new Textarea('months');
        $months->setRequired(true);
        $months->addValidator(new IntValidator(1, 12));
        $months->setLabel($lang->text('ocsguests', 'store_period'));
        $this->addElement($months);

        $submit = new Submit('save');
        $submit->setLabel($lang->text('skapi', 'save'));
        $this->addElement($submit);
    }

}

