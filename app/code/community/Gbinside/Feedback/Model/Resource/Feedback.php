<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 19/09/14
 */ 
class Gbinside_Feedback_Model_Resource_Feedback extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('gbfeedback/feedback', 'id');
    }

}