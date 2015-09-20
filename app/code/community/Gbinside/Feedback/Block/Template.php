<?php

/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 19/09/14
 */

class Gbinside_Feedback_Block_Template extends Mage_Core_Block_Template
{
    protected function _getAllowSymlinks() # fix per la 1.6.0.0
    {
        return true;
    }

    public function fetchView($fileName)
    {
        $this->setScriptPath(
            Mage::getModuleDir('', 'Gbinside_Feedback') . DS . 'templates'
        );

        return parent::fetchView($this->getTemplate());
    }
} 