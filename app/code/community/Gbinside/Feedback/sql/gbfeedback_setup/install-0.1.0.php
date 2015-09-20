<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 19/09/14
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$sql = "
CREATE TABLE IF NOT EXISTS `{$installer->getTable('gbfeedback/feedback')}` (
    `id` int(11) NOT NULL auto_increment,
    `issue` text NOT NULL,
    `image` longtext NOT NULL,
    `created_at` timestamp NOT NULL,

    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$installer->run($sql);

$installer->endSetup();