<?php
/**
 * Copyright (c) 2014, Skalfa LLC
 * All rights reserved.
 *
 * ATTENTION: This commercial software is intended for exclusive use with SkaDate Dating Software (http://www.skadate.com) and is licensed under SkaDate Exclusive License by Skalfa LLC.
 *
 * Full text of this license can be found at http://www.skadate.com/sel.pdf
 */

/**
 * Data Access Object for `matchmaking_question_match` table.
 *
 * @author Zarif Safiullin <zaph.saph@gmail.com>
 * @package ow.ow_plugins.matchmaking.bol
 * @since 1.0
 */
class MATCHMAKING_BOL_QuestionMatchDao extends OW_BaseDao
{
    /**
     * Singleton instance.
     *
     * @var MATCHMAKING_BOL_QuestionMatchDao
     */
    private static $classInstance;

    /**
     * Returns an instance of class (singleton pattern implementation).
     *
     * @return MATCHMAKING_BOL_QuestionMatchDao
     */
    public static function getInstance()
    {
        if ( self::$classInstance === null )
        {
            self::$classInstance = new self();
        }

        return self::$classInstance;
    }

    /**
     * @see OW_BaseDao::getDtoClassName()
     *
     */
    public function getDtoClassName()
    {
        return 'MATCHMAKING_BOL_QuestionMatch';
    }

    /**
     * @see OW_BaseDao::getTableName()
     *
     */
    public function getTableName()
    {
        return OW_DB_PREFIX . 'matchmaking_question_match';
    }

    /**
     * @return mixed|null|string
     */
    public function getMaxPercentValue()
    {
        $query = "SELECT SUM(`coefficient`) FROM " . $this->getTableName() . " WHERE `required`=0";

        return $this->dbo->queryForColumn($query);
    }

    /**
     * @return array|mixed
     */
    public function findRequiredMatchFields()
    {
        $example = new OW_Example();
        $example->andFieldEqual('required', 1);

        return $this->findListByExample($example);
    }

    /**
     * @return array|mixed
     */
    public function findFieldsExceptRequired()
    {
        $example = new OW_Example();
//        $example->andFieldEqual('required', 0);

        return $this->findListByExample($example);
    }

    /**
     * @param $userId
     * @return mixed|null|string
     */
    public function findMatchCount( $userId )
    {
        $params = $this->getQueryParams($userId);

        if (empty($params))
        {
            return 0;
        }

        $query = $this->prepareQuerySelectCount($params);

        return $this->dbo->queryForColumn($query);
    }

    /**
     * @param $userId
     * @param $sortOrder
     * @param $first
     * @param $count
     * @return array
     */
    public function findUserIdMatchListByQuestionValues( $userId, $sortOrder, $first, $count )
    {
        $params = $this->getQueryParams($userId, $sortOrder);

        if (empty($params))
        {
            return array();
        }

        $query = $this->prepareQuerySelect($params);
//pv($query);
        return $this->dbo->queryForList($query, array_merge(array('first' => $first, 'count' => $count)));
    }

    /**
     * @param $params
     * @return string
     */
    private function prepareQuerySelectCount( $params )
    {
        $queryParts = BOL_UserDao::getInstance()->getUserQueryFilter('user', "id", array(
            "method" => "MATCHMAKING_BOL_QuestionMatchDao::prepareQuerySelectCount"
        ));

        $sql = "SELECT COUNT(*) FROM (SELECT DISTINCT `user`.id, " . $params['compatibility'] . " as `compatibility` FROM `" . BOL_UserDao::getInstance()->getTableName() . "` `user`
        " . $queryParts['join'] . $params['join'] . "

        WHERE " . $queryParts['where'] ." AND `user`.`id`<>" . $params['userId'] . " " . $params['where'] . ") as `matches`
        WHERE `matches`.`compatibility` <> 0";

        return $sql;
    }

    /**
     * @param $params
     * @return string
     */
    private function prepareQuerySelect( $params )
    {
        $queryParts = BOL_UserDao::getInstance()->getUserQueryFilter('user', "id", array(
            "method" => "MATCHMAKING_BOL_QuestionMatchDao::prepareQuerySelect"
        ));

        $sql = "SELECT `matches`.`id`, `matches`.`compatibility`  FROM (SELECT DISTINCT `user`.id, " . $params['compatibility'] . " as `compatibility` FROM `" . BOL_UserDao::getInstance()->getTableName() . "` `user`
        " . $queryParts['join'] . $params['join'] . "

        WHERE " . $queryParts['where'] ." AND `user`.`id`<>" . $params['userId'] . " " . $params['where'] . ") as `matches`
        INNER JOIN `". OW_DB_PREFIX ."base_user` user ON user.`id` = `matches`.`id`
        WHERE `matches`.`compatibility` <> 0
        ORDER BY " . $params['order'] . " `user`.`activityStamp` DESC
        LIMIT :first, :count ";

        return $sql;
    }

    /**
     * @param $params
     * @return string
     */
    private function prepareQuerySelectForUserIdList( $params )
    {
        $queryParts = BOL_UserDao::getInstance()->getUserQueryFilter('user', "id", array(
            "method" => "MATCHMAKING_BOL_QuestionMatchDao::prepareQuerySelect"
        ));

        $sql = "SELECT `matches`.`id` as userId, `matches`.`compatibility`  FROM (SELECT DISTINCT `user`.*, " . $params['compatibility'] . " as `compatibility` FROM `" . BOL_UserDao::getInstance()->getTableName() . "` `user`
        " . $queryParts['join'] . $params['join'] . "

        WHERE " . $queryParts['where'] ." AND `user`.`id`<>" . $params['userId'] . " " . $params['where'] . ") as `matches`
        ORDER BY " . $params['order'] . " `matches`.`activityStamp` DESC
        LIMIT :first, :count ";

        return $sql;
    }

    /**
     * @param $userId
     * @param string $sortOrder
     * @return array
     */
    private function getQueryParams( $userId, $sortOrder = 'newest' )
    {
        $questionService = BOL_QuestionService::getInstance();
        $userService = BOL_UserService::getInstance();

        $matchFields = $this->findAll();
        $prefix = 'qd';
        $counter = 0;
        $innerJoin = '';
        $leftJoin = '';
        $where = '';
        $compatibility = '';

        foreach ( $matchFields as $field )
        {
            $question = $questionService->findQuestionByName($field->questionName);
            if (!$question)
            {
                continue;
            }
            $matchQuestion = $questionService->findQuestionByName($field->matchQuestionName);
            if (!$matchQuestion)
            {
                continue;
            }
            $checkData = $questionService->getQuestionData(array($userId), array($field->matchQuestionName));

            if ( empty($checkData[$userId][$field->matchQuestionName]) )
            {
                if ($field->required)
                {
                    return array();
                }
            }

            $value1 = null;

            if (isset($checkData[$userId][$field->matchQuestionName]))
            {
                $value1 = $checkData[$userId][$field->matchQuestionName];
            }

            if ( !empty($value1) )
            {
                if ( $field->required )
                {
                    $questionString = $this->prepareQuestionWhere($question, $value1, $prefix . $counter);

                    if ( !empty($questionString) )
                    {
                        if ( $question->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $innerJoin .= "
                                INNER JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter . "`
                            ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($question->name) . "' AND " . $questionString . " ) ";

                            //$compatibility .= ' IF( `' . $prefix . $counter . '`.`questionName` IS NOT NULL, ' . MATCHMAKING_BOL_Service::MAX_COEFFICIENT . ', 0 ) +';
                            $counter++;
                        }
                    }

                    $checkData2 = $questionService->getQuestionData(array($userId), array($field->questionName));

                    if ( empty($checkData2[$userId][$field->questionName]) )
                    {
                        continue;
                    }
                    $value2 = $checkData2[$userId][$field->questionName];

                    $questionString = $this->prepareQuestionWhere($matchQuestion, $value2, $prefix . $counter);
                    if ( !empty($questionString) )
                    {
                        if ( $matchQuestion->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $innerJoin .= "
                                INNER JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter . "`
                            ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($matchQuestion->name) . "' AND " . $questionString . " ) ";

                            $counter++;
                        }
                    }
                }
                else
                {
                    $questionString = $this->prepareQuestionWhere($question, $value1, $prefix . $counter);

                    if ( !empty($questionString) )
                    {
                        if ( $question->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $leftJoin .= "
                                LEFT JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter
                                . "` ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($question->name) . "' AND " . $questionString . " ) ";

                            $compatibility .= ' IF( `' . $prefix . $counter . '`.`questionName` IS NOT NULL, ' . $field->coefficient . ', 0 ) +';
                            $counter++;
                        }
                    }
                }
            }
            else
            {
                $compatibility .= ' ' . $field->coefficient . ' +';
            }
        }

        /**/

        if ( $sortOrder == 'newest' )
        {
            $order = ' `user`.`joinStamp` DESC, ';
        }
        else if ( $sortOrder == 'mail' )
        {
            $order = ' `user`.`joinStamp` DESC, ';

            $matchmaking_lastmatch_userid = BOL_PreferenceService::getInstance()->getPreferenceValue('matchmaking_lastmatch_userid', $userId );

            $where = ' AND `user`.`id` > '.$matchmaking_lastmatch_userid;
        }
        else if ( $sortOrder == 'compatible' )
        {
            //$order = '(' . substr($compatibility, 0, -1) . ') DESC , ';
            $order = '`matches`.`compatibility` DESC , ';
        }

        if (empty($compatibility))
        {
            return array();
        }

        $result = array(
            'userId' => $userId,
            'join' => $innerJoin . $leftJoin,
            'where' => $where,
            'order' => $order,
            'compatibility' => '(' . substr($compatibility, 0, -1) . ')'
        );

//        pve($result);

        return $result;
    }

    private function getQueryParamsForUserIdList( $userId, $userIdList, $sortOrder = 'newest' )
    {
        $questionService = BOL_QuestionService::getInstance();
        $userService = BOL_UserService::getInstance();

        $matchFields = $this->findAll();
        $prefix = 'qd';
        $counter = 0;
        $innerJoin = '';
        $leftJoin = '';
        $where = '';
        $compatibility = '';

        foreach ( $matchFields as $field )
        {
            $question = $questionService->findQuestionByName($field->questionName);
            $matchQuestion = $questionService->findQuestionByName($field->matchQuestionName);

            $checkData = $questionService->getQuestionData(array($userId), array($field->matchQuestionName));

            if ( empty($checkData[$userId][$field->matchQuestionName]) )
            {
                if ($field->required)
                {
                    return array();
                }
            }

            $value1 = null;

            if (isset($checkData[$userId][$field->matchQuestionName]))
            {
                $value1 = $checkData[$userId][$field->matchQuestionName];
            }

            if ( !empty($value1) )
            {
                if ( $field->required )
                {
                    $questionString = $this->prepareQuestionWhere($question, $value1, $prefix . $counter);

                    if ( !empty($questionString) )
                    {
                        if ( $question->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $innerJoin .= "
                                LEFT JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter . "`
                            ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($question->name) . "' AND " . $questionString . " ) ";

                            //$compatibility .= ' IF( `' . $prefix . $counter . '`.`questionName` IS NOT NULL, ' . MATCHMAKING_BOL_Service::MAX_COEFFICIENT . ', 0 ) +';
                            $counter++;
                        }
                    }

                    $checkData2 = $questionService->getQuestionData(array($userId), array($field->questionName));

                    if ( empty($checkData2[$userId][$field->questionName]) )
                    {
                        continue;
                    }
                    $value2 = $checkData2[$userId][$field->questionName];

                    $questionString = $this->prepareQuestionWhere($matchQuestion, $value2, $prefix . $counter);
                    if ( !empty($questionString) )
                    {
                        if ( $matchQuestion->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $innerJoin .= "
                                LEFT JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter . "`
                            ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($matchQuestion->name) . "' AND " . $questionString . " ) ";

                            $counter++;
                        }
                    }
                }
                else
                {
                    $questionString = $this->prepareQuestionWhere($question, $value1, $prefix . $counter);

                    if ( !empty($questionString) )
                    {
                        if ( $question->base == 1 )
                        {
                            $where .= ' OR ' . $questionString;
                        }
                        else
                        {
                            $leftJoin .= "
                                LEFT JOIN `" . BOL_QuestionDataDao::getInstance()->getTableName() . "` `" . $prefix . $counter
                                . "` ON ( `user`.`id` = `" . $prefix . $counter . "`.`userId` AND `" . $prefix . $counter . "`.`questionName` = '" . $this->dbo->escapeString($question->name) . "' AND " . $questionString . " ) ";

                            $compatibility .= ' IF( `' . $prefix . $counter . '`.`questionName` IS NOT NULL, ' . $field->coefficient . ', 0 ) +';
                            $counter++;
                        }
                    }
                }
            }
            else
            {
                $compatibility .= ' ' . $field->coefficient . ' +';
            }
        }

        /**/

        if ( $sortOrder == 'newest' )
        {
            $order = ' `user`.`joinStamp` DESC, ';
        }
        else if ( $sortOrder == 'compatible' )
        {
            $order = '`matches`.`compatibility` DESC , ';
            $listOfUserIds = $this->dbo->mergeInClause($userIdList);
            $where .= ' AND `user`.`id` IN ( '.$listOfUserIds.' ) ';
        }

        $result = array(
            'userId' => $userId,
            'userIdList' => $userIdList,
            'join' => $innerJoin . $leftJoin,
            'where' => $where,
            'order' => $order,
            'compatibility' => '(' . substr($compatibility, 0, -1) . ')'
        );

//        pve($result);

        return $result;
    }
    /**
     * @param BOL_Question $question
     * @param $value
     * @param string $prefix
     * @return array|string
     */
    private function prepareQuestionWhere( BOL_Question $question, $value, $prefix = '' )
    {
        $result = '';
        $prefix = $this->dbo->escapeString($prefix);

        switch ( $question->presentation )
        {
            case BOL_QuestionService::QUESTION_PRESENTATION_URL :
            case BOL_QuestionService::QUESTION_PRESENTATION_TEXT :
            case BOL_QuestionService::QUESTION_PRESENTATION_TEXTAREA :
                if ( $question->base )
                {
                    $result = ' `user`.`' . $this->dbo->escapeString($question->name) . '` LIKE \'' . $this->dbo->escapeString($value) . '%\'';
                }
                else
                {
                    $result = " LCASE(`" . $prefix . "`.`textValue`) LIKE '" . $this->dbo->escapeString(strtolower($value)) . "%'";
                }
                break;

            case BOL_QuestionService::QUESTION_PRESENTATION_CHECKBOX :
                if ( $question->base )
                {
                    $result = ' `user`.`' . $this->dbo->escapeString($question->name) . '` = ' . (boolean) $value;
                }
                else
                {
                    $result = " `" . $prefix . "`.`intValue` = " . (boolean) $value;
                }
                break;

            case BOL_QuestionService::QUESTION_PRESENTATION_MULTICHECKBOX :
                if ( $question->base )
                {
                    $result = ' `user`.`' . $this->dbo->escapeString($question->name) . '` & ' . $value . ' ';
                }
                else
                {
                    $result = ' `' . $this->dbo->escapeString($prefix) . '`.`intValue` & ' . $value . ' ';
                }

                break;


            case BOL_QuestionService::QUESTION_PRESENTATION_RADIO :
            case BOL_QuestionService::QUESTION_PRESENTATION_SELECT :
                $questionValues = BOL_QuestionService::getInstance()->findQuestionValues($question->name);

                if ( !empty($questionValues) )
                {
                    $result = array();
                    foreach ( $questionValues as $val )
                    {
                        if ( (bool)($val->value & (int)$value) )
                        {
                            $result[] = $val->value;
                        }
                    }
                    $value = $result;
                }

                if ( isset($value) && is_array($value) && !empty($value) )
                {
                    if ( $question->base )
                    {
                        $result = ' `user`.`' . $this->dbo->escapeString($question->name) . '` IN ( ' . $this->dbo->mergeInClause($value) . ' ) ';
                    }
                    else
                    {
                        $result = ' `' . $this->dbo->escapeString($prefix) . '`.`intValue` IN ( ' . $this->dbo->mergeInClause($value) . ' ) ';
                    }
                }

                break;

            case BOL_QuestionService::QUESTION_PRESENTATION_DATE :
            case BOL_QuestionService::QUESTION_PRESENTATION_BIRTHDATE :
            case BOL_QuestionService::QUESTION_PRESENTATION_AGE :


                $value = explode('-', $value);
                $value = array('from' => $value[0], 'to' => $value[1]);

                if ( isset($value['from']) && isset($value['to']) )
                {
                    $maxDate = ( date('Y') - (int) $value['from'] ) . '-12-31';
                    $minDate = ( date('Y') - (int) $value['to'] ) . '-01-01';

                    if ( $question->base )
                    {
                        $result = " `user`.`" . $this->dbo->escapeString($question->name) . "` BETWEEN  '" . $this->dbo->escapeString($minDate) . "' AND '" . $this->dbo->escapeString($maxDate) . "'";
                    }
                    else
                    {
                        $result = " `" . $prefix . "`.`dateValue` BETWEEN  '" . $this->dbo->escapeString($minDate) . "' AND '" . $this->dbo->escapeString($maxDate) . "'";
                    }
                }

                break;

            case BOL_QuestionService::QUESTION_PRESENTATION_RANGE:
                $date = UTIL_DateTime::parseDate($value, UTIL_DateTime::MYSQL_DATETIME_DATE_FORMAT);
                $value = UTIL_DateTime::getAge($date['year'], $date['month'], $date['day']);
                if ( $question->base )
                {
                    $result = " " . $value . " BETWEEN SUBSTRING(`user`.`" . $this->dbo->escapeString($question->name) . "`, 1, LOCATE('-', `user`.`" . $this->dbo->escapeString($question->name) . "`)-1 ) AND SUBSTRING(`user`.`" . $this->dbo->escapeString($question->name) . "`, LOCATE('-', `user`.`" . $this->dbo->escapeString($question->name) . "`)+1 ) ";
                }
                else
                {
                    $result = " " . $value . " BETWEEN SUBSTRING(`" . $prefix . "`.`textValue`, 1, LOCATE('-', `" . $prefix . "`.`textValue`)-1 ) AND SUBSTRING(`" . $prefix . "`.`textValue`, LOCATE('-', `" . $prefix . "`.`textValue`)+1 )  ";
                }
                break;
        }

        return $result;
    }

    public function findRuleByQuestionName( $questionName )
    {
        $example = new OW_Example();
        $example->andFieldEqual('questionName', $questionName);

        return $this->findObjectByExample($example);
    }

    public function findMatchQuestionsForUser( $userId )
    {
        if ( $userId === null )
        {
            return array();
        }

        if (!OW::getPluginManager()->isPluginActive('skadate'))
        {
            return array();
        }

        $genderAccTypes = SKADATE_BOL_AccountTypeToGenderService::getInstance()->findAll();
        $lookingForValue = BOL_QuestionService::getInstance()->getQuestionData(array($userId), array('match_sex'));
        $lookingForValues = array();
        foreach($genderAccTypes as $type)
        {
            if ($lookingForValue[$userId]['match_sex'] & $type->genderValue)
            {
                $lookingForValues[] = $type->genderValue;
            }
        }

        if (empty($lookingForValues))
        {
            return array();
        }

        $lookingForValues = $this->dbo->mergeInClause($lookingForValues);
        $sql = " SELECT DISTINCT `question`.* FROM `" . BOL_QuestionDao::getInstance()->getTableName() . "` as `question`

                    LEFT JOIN  `" . BOL_QuestionSectionDao::getInstance()->getTableName() . "` as `section`
                            ON ( `question`.`sectionName` = `section`.`name` AND `question`.`sectionName` != '' AND `question`.`sectionName` IS NOT NULL )

                    LEFT JOIN " . BOL_QuestionToAccountTypeDao::getInstance()->getTableName() . " as `qta` ON ( `question`.`parent` = `qta`.`questionName` )

                    LEFT JOIN `". SKADATE_BOL_AccountTypeToGenderDao::getInstance()->getTableName() ."` as `atg` ON (`qta`.`accountType` = `atg`.`accountType`)

                    WHERE `question`.`sectionName`='about_my_match' AND `atg`.`genderValue` IN ( {$lookingForValues} )

                    ORDER BY IF( `section`.`name` IS NULL, 0, 1 ),  `section`.`sortOrder`, `question`.`sortOrder` ";

        return $this->dbo->queryForList($sql);
    }

    public function findCompatibilityByUserIdList($userId, $userIdList, $first, $count, $sortOrder)
    {
        $params = $this->getQueryParamsForUserIdList($userId, $userIdList, $sortOrder);

        $query = $this->prepareQuerySelectForUserIdList($params);

        return $this->dbo->queryForList($query, array_merge(array('first' => $first, 'count' => $count)));
    }
}