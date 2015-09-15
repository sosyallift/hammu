<?php

/**
 * Copyright (c) 2009, Skalfa LLC
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */

/**
 * @author Egor Bulgakov <egor.bulgakov@gmail.com>
 * @package ow_plugins.user_credits.classes
 * @since 1.6.0
 */
class USERCREDITS_CLASS_EventHandler
{
    /**
     * @var USERCREDITS_CLASS_EventHandler
     */
    private static $classInstance;

    /**
     * @return USERCREDITS_CLASS_EventHandler
     */
    public static function getInstance()
    {
        if ( self::$classInstance === null )
        {
            self::$classInstance = new self();
        }

        return self::$classInstance;
    }

    private function __construct() { }

    public function onCollectProfileActionToolbarItem( BASE_CLASS_EventCollector $event )
    {
        $params = $event->getParams();

        if ( empty($params['userId']) )
        {
            return;
        }

        if ( !OW::getUser()->isAuthenticated() )
        {
            return;
        }

        $userId = (int) $params['userId'];
        $linkId = 'gi' . rand(10, 1000000);

        $creditsService = USERCREDITS_BOL_CreditsService::getInstance();
        $balance = $creditsService->getCreditsBalance($userId);

        $resultArray = array();
        
        if ( OW::getUser()->isAuthorized('usercredits') ) // moderator can edit credits balance
        {
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_ITEM_KEY] = 'usercredits.set_credits';
            
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LINK_GROUP_KEY] = 'base.moderation';
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LINK_GROUP_LABEL] = OW::getLanguage()->text('base', 'profile_toolbar_group_moderation');
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LINK_ORDER] = 0;
            
            $label = OW::getLanguage()->text('usercredits', 'profile_toolbar_item_credits', array('credits' => $balance));
            
            $fbSettings = array(
                "width" => 300,
                "title" => $label
            );
            
            $fbParams = array($userId, false);
            
            $js = UTIL_JsGenerator::newInstance()->jQueryEvent("#" . $linkId, "click",
                'var self = $(this); OW.ajaxFloatBox("USERCREDITS_CMP_SetCredits", e.data.params , $.extend({}, e.data.settings, {scope: { btn: $(this), callBack: function(r) {
                    if (r.text) self.find(".usercredits_btn_label_text").text(r.text);
                 }}}));',
            array('e'), array(
                "params" => $fbParams,
                "settings" => $fbSettings
            ));
            
            $script = $js->generateJs();
        }
        else // all the others can grant some amount of credits, if available
        {
            if ( $params['userId'] == OW::getUser()->getId() )
            {
                return;
            }

            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_ITEM_KEY] = 'usercredits.send_credits';
            
            $grantorBalance = $creditsService->getCreditsBalance(OW::getUser()->getId());
            $label = OW::getLanguage()->text('usercredits', 'profile_toolbar_grant');

            if ( $grantorBalance )
            {
                $script = '$("#' . $linkId . '").click(function(){
                document.grantCreditsFloatBox = OW.ajaxFloatBox(
                    "USERCREDITS_CMP_GrantCredits",
                    { userId: ' . $userId . ' },
                    { width: 400, title: "' . $label . '" }
                );
                });';
            }
        }

        if ( !empty($script) )
        {
            OW::getDocument()->addOnloadScript($script);

            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LABEL] = '<span class="usercredits_btn_label_text">' . $label . '</span>';
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LINK_HREF] = 'javascript://';
            $resultArray[BASE_CMP_ProfileActionToolbar::DATA_KEY_LINK_ID] = $linkId;
            
            $event->add($resultArray);
        }
    }

    public function onCollectQuickLinks( BASE_CLASS_EventCollector $event )
    {
        $service = USERCREDITS_BOL_CreditsService::getInstance();
        $userId = OW::getUser()->getId();

        $creditsCount = (int) $service->getCreditsBalance($userId);

        $event->add(array(
            BASE_CMP_QuickLinksWidget::DATA_KEY_LABEL => OW::getLanguage()->text('usercredits', 'my_credits_quick_link'),
            BASE_CMP_QuickLinksWidget::DATA_KEY_URL => OW::getRouter()->urlForRoute('usercredits.buy_credits'),
            BASE_CMP_QuickLinksWidget::DATA_KEY_COUNT => $creditsCount,
            BASE_CMP_QuickLinksWidget::DATA_KEY_COUNT_URL => OW::getRouter()->urlForRoute('usercredits.buy_credits')
        ));
    }

    public function onCollectAuthLabels( BASE_CLASS_EventCollector $event )
    {
        $language = OW::getLanguage();
        $event->add(
            array(
                'usercredits' => array(
                    'label' => $language->text('usercredits', 'auth_group_label')
                )
            )
        );
    }

    /**
     * Adds listener to the event collecting user credits actions
     * submitted by other plugins on installation
     *
     * @param BASE_CLASS_EventCollector $coll
     */
    public function onCollectActions( BASE_CLASS_EventCollector $coll )
    {
        $data = $coll->getData();

        if ( !count($data) )
        {
            return;
        }

        USERCREDITS_BOL_CreditsService::getInstance()->collectActions($data);
    }

    /**
     * Adds listener to the event collecting user credits actions for update
     *
     * @param BASE_CLASS_EventCollector $coll
     */
    public function actionUpdate( BASE_CLASS_EventCollector $coll )
    {
        $data = $coll->getData();

        if ( !count($data) )
        {
            return;
        }

        USERCREDITS_BOL_CreditsService::getInstance()->updateActions($data);
    }

    /**
     * Adds listener to the event collecting user credits actions for removal
     *
     * @param BASE_CLASS_EventCollector $coll
     */
    public function actionDelete( BASE_CLASS_EventCollector $coll )
    {
        $data = $coll->getData();

        if ( !count($data) )
        {
            return;
        }

        USERCREDITS_BOL_CreditsService::getInstance()->deleteActions($data);
    }

    public function actionInfo( OW_Event $event )
    {
        $params = $event->getParams();

        $info = null;
        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            $actionDto = $creditsService->findAction($params['pluginKey'], $params['action']);

            if ( $actionDto )
            {
                $info = array();
                if ( isset($params['userId']) )
                {
                    $actionPrice = $creditsService->findActionPriceForUser($actionDto->id, $params['userId']);
                    if ( $actionPrice )
                    {
                        $info['price'] = $actionPrice->amount;
                        $info['disabled'] = $actionPrice->disabled;
                    }
                }
                $info['label'] = $creditsService->getActionTitle($params['pluginKey'], $params['action']);
            }
        }

        $event->setData($info);

        return $info;
    }

    /**
     * Adds listener to 'usercredits.check_balance' event
     *
     * @param OW_Event $e
     * @return bool
     */
    public function checkBalance( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        if ( !$userId )
        {
            return true;
        }

        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $extra = isset($params['extra']) ? $params['extra'] : null;
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            return $creditsService->checkBalance($params['pluginKey'], $params['action'], $userId, $extra);
        }

        return false;
    }

    public function batchCheckBalance( OW_Event $e )
    {
        $params = $e->getParams();

        if ( empty($params['userIdList']) || !is_array($params['userIdList']) )
        {
            return array();
        }

        $userIdList = $params['userIdList'];

        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            return $creditsService->checkBalanceForUserList($params['pluginKey'], $params['action'], $userIdList);
        }

        return array();
    }

    public function batchCheckBalanceForActionList( OW_Event $e )
    {
        $params = $e->getParams();

        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        if ( !$userId )
        {
            return true;
        }

        if ( empty($params['actionList']) || !is_array($params['actionList']) )
        {
            return array();
        }

        $actionList = $params['actionList'];

        $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

        return $creditsService->checkBalanceForActionList($actionList, $userId);
    }

    public function getBalance( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

        return $creditsService->getCreditsBalance($userId);
    }

    /**
     * Adds listener to 'usercredits.track_action' event
     *
     * @param OW_Event $e
     * @return bool
     */
    public function trackAction( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $checkInterval = isset($params['checkInterval']) ? (bool) $params['checkInterval'] : true;
            $extra = isset($params['extra']) ? $params['extra'] : null;
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            return $creditsService->trackAction($params['pluginKey'], $params['action'], $userId, $checkInterval, $extra);
        }

        return false;
    }

    /**
     * Adds listener to 'usercredits.error_message' event
     *
     * @param OW_Event $e
     * @return bool|string
     */
    public function getErrorMessage( OW_Event $e )
    {
        $params = $e->getParams();

        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            $title = $creditsService->getActionTitle($params['pluginKey'], $params['action']);

            return OW::getLanguage()->text('usercredits', 'not_enough_credits',
                array('actionTitle' => mb_strtolower($title), 'getCreditsUrl' => OW::getRouter()->urlForRoute('usercredits.buy_credits'))
            );
        }

        return false;
    }

    /**
     * Adds listener to 'usercredits.last_action_timestamp' event
     *
     * @param OW_Event $e
     * @return int|null
     */
    public function getLastActionTimestamp( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        if ( isset($params['pluginKey']) && isset($params['action']) )
        {
            $creditsService = USERCREDITS_BOL_CreditsService::getInstance();

            $action = $creditsService->findAction($params['pluginKey'], $params['action']);

            if ( !$action )
            {
                return null;
            }

            $log = $creditsService->findLog($userId, $action->id);

            return $log ? $log->logTimestamp : 0;
        }

        return null;
    }

    public function onBeforePluginsUninstall( OW_Event $e )
    {
        $params = $e->getParams();
        $pluginKey = $params['pluginKey'];

        if ( $pluginKey == 'usercredits' )
        {
            USERCREDITS_BOL_CreditsService::getInstance()->deleteActionsByPluginKey();
        }
        else
        {
            USERCREDITS_BOL_CreditsService::getInstance()->deleteActionsByPluginKey($pluginKey);
        }
    }

    public function onAfterPluginsActivate( OW_Event $e )
    {
        $params = $e->getParams();
        $pluginKey = $params['pluginKey'];

        USERCREDITS_BOL_CreditsService::getInstance()->activateActionsByPluginKey($pluginKey);

        if ( $pluginKey == 'usercredits' )
        {
            BOL_BillingService::getInstance()->addConfig('billingccbill', 'clientSubaccCredits', '0000');
        }
    }

    public function onBeforePluginsDeactivate( OW_Event $e )
    {
        $params = $e->getParams();
        $pluginKey = $params['pluginKey'];

        USERCREDITS_BOL_CreditsService::getInstance()->deactivateActionsByPluginKey($pluginKey);

        if ( $pluginKey == 'usercredits' )
        {
            BOL_BillingService::getInstance()->deleteConfig('billingccbill', 'clientSubaccCredits');
        }
    }

    public function onUserLogin( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        $creditService = USERCREDITS_BOL_CreditsService::getInstance();

        $credits = $creditService->checkBalance('base', 'daily_login', $userId);

        if ( $credits === true )
        {
            $action = $creditService->findAction('base', 'daily_login');
            $last = $creditService->findLog($userId, $action->id);

            if ( $last && (time() - $last->logTimestamp < 24 * 60 * 60) )
            {
                return;
            }

            $creditService->trackAction('base', 'daily_login', $userId);
        }
    }

    public function onFriendRequestSent( OW_Event $e )
    {
        $params = $e->getParams();
        $recipientId = $params['recipientId'];
        $senderId = $params['senderId'];

        $creditService = USERCREDITS_BOL_CreditsService::getInstance();

        if ( $creditService->checkBalance('friends', 'add_friend', $senderId) === true )
        {
            $creditService->trackAction('friends', 'add_friend', $senderId);
        }
    }

    public function onUserRegister( OW_Event $e )
    {
        $params = $e->getParams();
        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        $creditService = USERCREDITS_BOL_CreditsService::getInstance();

        $credits = $creditService->checkBalance('base', 'user_join', $userId);

        if ( $credits === true )
        {
            $creditService->trackAction('base', 'user_join', $userId);
        }
    }

    public function onBirthday( OW_Event $e )
    {
        $params = $e->getParams();
        $userIds = $params['userIdList'];

        $creditService = USERCREDITS_BOL_CreditsService::getInstance();

        foreach ( $userIds as $userId )
        {
            $credits = $creditService->checkBalance('birthdays', 'birthday', $userId);

            if ( $credits === true )
            {
                $creditService->trackAction('birthdays', 'birthday', $userId);
            }
        }
    }

    public function onAfterApplicationInit()
    {
        // Collect user credits actions
        if ( !OW::getConfig()->getValue('usercredits', 'is_once_initialized') )
        {
            if ( OW::getConfig()->configExists('usercredits', 'is_once_initialized') )
            {
                OW::getConfig()->saveConfig('usercredits', 'is_once_initialized', 1);
            }
            else
            {
                OW::getConfig()->addConfig('usercredits', 'is_once_initialized', 1);
            }

            $event = new BASE_CLASS_EventCollector('usercredits.on_action_collect');
            OW::getEventManager()->trigger($event);

            $actions = $event->getData();

            if ( $actions )
            {
                USERCREDITS_BOL_CreditsService::getInstance()->collectActions($actions);
            }
        }
    }

    public function onCollectBillingGatewayProduct( BASE_CLASS_EventCollector $event )
    {
        $service = USERCREDITS_BOL_CreditsService::getInstance();
        $packs = $service->getAllPackList();

        if ( !$packs )
        {
            return;
        }

        $data = array();
        foreach ( $packs as $pack )
        {
            $data[] = array(
                'pluginKey' => 'usercredits', 
                'label' => $pack['title'], 
                'entityType' => 'user_credits_pack', 
                'entityId' => $pack['id']
            );
        }

        $event->add($data);
    }

    public function onCollectNotificationActions( BASE_CLASS_EventCollector $e )
    {
        $e->add(array(
            'section' => 'usercredits',
            'action' => 'usercredits-grant_credits',
            'sectionIcon' => 'ow_ic_star',
            'sectionLabel' => OW::getLanguage()->text('usercredits', 'email_notifications_section_label'),
            'description' => OW::getLanguage()->text('usercredits', 'email_notifications_setting_grant'),
            'selected' => true
        ));
    }

    /**
     * @param OW_Event $e
     */
    public function onAccountTypeAdd( OW_Event $e )
    {
        $params = $e->getParams();
        $accTypeId = $params['id'];

        $service = USERCREDITS_BOL_CreditsService::getInstance();
        $actions = $service->findAllAddedActions();

        if ( $actions )
        {
            foreach ( $actions as $action )
            {
                $service->addActionPrice($action->id, $accTypeId, 0);
            }
        }
    }

    /**
     * @param OW_Event $e
     */
    public function onAccountTypeDelete( OW_Event $e )
    {
        $params = $e->getParams();
        $accTypeId = $params['id'];

        USERCREDITS_BOL_CreditsService::getInstance()->deleteActionPricesByAccountType($accTypeId);
    }
    
    public function onGrantCredits( OW_Event $e )
    {
        $params = $e->getParams();

        $amount = (int) $params['amount'];
        $grantorId = (int) $params['grantorId'];
        $userId = (int) $params['userId'];

        $userService = BOL_UserService::getInstance();
        $avatars = BOL_AvatarService::getInstance()->getDataForUserAvatars(array($grantorId));

        $params = array(
            'pluginKey' => 'usercredits',
            'entityType' => 'usercredits_grant_credits',
            'entityId' => crc32($userId . '-' . $grantorId . '-' . time()),
            'action' => 'usercredits-grant_credits',
            'userId' => $userId,
            'time' => time()
        );

        $data = array(
            'avatar' => $avatars[$grantorId],
            'string' => array(
                'key' => 'usercredits+email_notifications_grant_credits',
                'vars' =>array(
                    'userName' => $userService->getDisplayName($grantorId),
                    'userUrl' => $userService->getUserUrl($grantorId),
                    'amount' => $amount
                )
            ),
            'url' => $userService->getUserUrl($grantorId)
        );

        $event = new OW_Event('notifications.add', $params, $data);
        OW::getEventManager()->trigger($event);
    }

    public function onGetCcbillSubaccountConfigValue( OW_Event $e )
    {
        $params = $e->getParams();

        if ( $params['pluginKey'] != 'usercredits' || $params['entityKey'] != 'user_credits_pack' )
        {
            return;
        }

        $conf = BOL_BillingService::getInstance()->getGatewayConfigValue(
            BILLINGCCBILL_CLASS_CcbillAdapter::GATEWAY_KEY, 'clientSubaccCredits'
        );

        $e->setData($conf);
    }

    public function onCollectCcbillSubaccountField( BASE_CLASS_EventCollector $e )
    {
        $item = array(
            'key' => 'clientSubaccCredits',
            'label' => OW::getLanguage()->text('usercredits', 'ccbill_subaccount_label')
        );
        $e->add($item);
    }

    public function onAuthLayerCheck( BASE_CLASS_EventCollector $event )
    {
        $params = $event->getParams();
        if ( empty($params['groupName']) || empty($params['actionName']) )
        {
            return;
        }

        $groupName = $params['groupName'];
        $actionName = $params['actionName'];
        $userId = $params['userId'];

        $actionEvent = new OW_Event('usercredits.get_action_key', $params);
        OW::getEventManager()->trigger($actionEvent);
        $data = $actionEvent->getData();

        $actionKey = !empty($data) ? $data : $actionName;

        $service = USERCREDITS_BOL_CreditsService::getInstance();
        $action = $service->findAction($groupName, $actionKey);

        if ( !$action )
        {
            return;
        }

        $permission = $service->checkBalance($groupName, $actionKey, $userId, $params['extra']);

        $data = array(
            'pluginKey' => 'usercredits',
            'priority' => 2,
            'permission' => $permission
        );

        $event->add($data);
    }

    public function onAuthLayerCheckCollectError( BASE_CLASS_EventCollector $event )
    {
        $params = $event->getParams();
        if ( empty($params['groupName']) || empty($params['actionName']) )
        {
            return;
        }

        $actionName = $params['actionName'];
        $groupName = $params['groupName'];
        $userId = $params['userId'];

        $actionEvent = new OW_Event('usercredits.get_action_key', $params);
        OW::getEventManager()->trigger($actionEvent);
        $data = $actionEvent->getData();

        $actionKey = !empty($data) ? $data : $actionName;

        $service = USERCREDITS_BOL_CreditsService::getInstance();
        $action = $service->findAction($groupName, $actionKey);

        if ( !$action )
        {
            return;
        }

        $permission = $service->checkBalance($groupName, $actionKey, $userId, $params['extra']);
        if ( $permission === true || $permission === -1 )
        {
            return;
        }

        $data = array(
            'pluginKey' => 'usercredits',
            'label' => OW::getLanguage()->text('usercredits', 'buy_credits_page_heading'),
            'url' => OW::getRouter()->urlForRoute('usercredits.buy_credits'),
            'priority' => 2
        );

        $event->add($data);
    }

    public function onAuthLayerCheckTrackAction( BASE_CLASS_EventCollector $event )
    {
        $params = $event->getParams();

        $actionEvent = new OW_Event('usercredits.get_action_key', $params);
        OW::getEventManager()->trigger($actionEvent);
        $data = $actionEvent->getData();

        $actionName = $params['actionName'];
        $groupName = $params['groupName'];
        $actionKey = !empty($data) ? $data : $actionName;

        $userId = !empty($params['userId']) ? (int) $params['userId'] : OW::getUser()->getId();

        $extra = null;
        $checkInterval = true;
        if ( isset($params['extra']) )
        {
            $extra = $params['extra'];
            $checkInterval = isset($params['extra']['checkInterval']) ? (bool) $params['extra']['checkInterval'] : true;
        }

        $service = USERCREDITS_BOL_CreditsService::getInstance();

        $tracked = $service->trackAction($groupName, $actionKey, $userId, $checkInterval, $extra);

        if ( $tracked['status'] )
        {
            $key = $tracked['amount'] < 0 ? 'user_spent_credits' : 'user_received_credits';
            $data = array(
                'pluginKey' => 'usercredits',
                'msg' => OW::getLanguage()->text('usercredits', $key, array('amount' => abs($tracked['amount']))),
                'priority' => 2
            );

            $event->add($data);
        }
    }

    public function init()
    {
        $this->genericInit();
        $em = OW::getEventManager();

        $em->bind(BASE_CMP_ProfileActionToolbar::EVENT_NAME, array($this, 'onCollectProfileActionToolbarItem'));
        $em->bind(BASE_CMP_QuickLinksWidget::EVENT_NAME, array($this, 'onCollectQuickLinks'));
        $em->bind(OW_EventManager::ON_BEFORE_PLUGIN_UNINSTALL, array($this, 'onBeforePluginsUninstall'));
        $em->bind(OW_EventManager::ON_AFTER_PLUGIN_ACTIVATE, array($this, 'onAfterPluginsActivate'));
        $em->bind(OW_EventManager::ON_BEFORE_PLUGIN_DEACTIVATE, array($this, 'onBeforePluginsDeactivate'));
        $em->bind('birthdays.today_birthday_user_list', array($this, 'onBirthday'));
        $em->bind(BOL_QuestionService::EVENT_ON_ACCOUNT_TYPE_ADD, array($this, 'onAccountTypeAdd'));
        $em->bind(BOL_QuestionService::EVENT_ON_ACCOUNT_TYPE_DELETE, array($this, 'onAccountTypeDelete'));
    }

    public function genericInit()
    {
        $em = OW::getEventManager();

        $em->bind('admin.add_auth_labels', array($this, 'onCollectAuthLabels'));
        $em->bind('usercredits.action_add', array($this, 'onCollectActions'));
        $em->bind('usercredits.action_update', array($this, 'actionUpdate'));
        $em->bind('usercredits.action_delete', array($this, 'actionDelete'));
        $em->bind('usercredits.action_info', array($this, 'actionInfo'));
        $em->bind('usercredits.check_balance', array($this, 'checkBalance'));
        $em->bind('usercredits.batch_check_balance', array($this, 'batchCheckBalance'));
        $em->bind('usercredits.batch_check_balance_for_action_list', array($this, 'batchCheckBalanceForActionList'));
        $em->bind('usercredits.get_balance', array($this, 'getBalance'));
        $em->bind('usercredits.track_action', array($this, 'trackAction'));
        $em->bind('usercredits.error_message', array($this, 'getErrorMessage'));
        $em->bind('usercredits.last_action_timestamp', array($this, 'getLastActionTimestamp'));
        $em->bind(OW_EventManager::ON_USER_LOGIN, array($this, 'onUserLogin'));
        $em->bind('friends.request-sent', array($this, 'onFriendRequestSent'));
        $em->bind(OW_EventManager::ON_USER_REGISTER, array($this, 'onUserRegister'));
        $em->bind(OW_EventManager::ON_APPLICATION_INIT, array($this, 'onAfterApplicationInit'));
        $em->bind('base.billing_add_gateway_product', array($this, 'onCollectBillingGatewayProduct'));
        $em->bind('notifications.collect_actions', array($this, 'onCollectNotificationActions'));
        $em->bind('usercredits.grant', array($this, 'onGrantCredits'));
        $em->bind('billingccbill.get-subaccount-config', array($this, 'onGetCcbillSubaccountConfigValue'));
        $em->bind('billingccbill.collect-subaccount-fields', array($this, 'onCollectCcbillSubaccountField'));

        $em->bind('authorization.layer_check', array($this, 'onAuthLayerCheck'));
        $em->bind('authorization.layer_check_collect_error', array($this, 'onAuthLayerCheckCollectError'));
        $em->bind('authorization.layer_check_track_action', array($this, 'onAuthLayerCheckTrackAction'), 1);

        $credits = new USERCREDITS_CLASS_BaseCredits();
        $em->bind('usercredits.on_action_collect', array($credits, 'bindCreditActionsCollect'));
    }
}