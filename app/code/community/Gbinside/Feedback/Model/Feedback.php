<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 19/09/14
 */
class Gbinside_Feedback_Model_Feedback extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('gbfeedback/feedback');
    }

    protected function _beforeSave()
    {
        if ($this->isObjectNew() && null === $this->getCreatedAt()) {
            $this->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());
        }
        return parent::_beforeSave();
    }

}