<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */


$installer = $this;

$installer->startSetup();

$installer->run("
	CREATE TABLE IF NOT EXISTS {$this->getTable('jsa_store')} (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `isocode2` char(2) DEFAULT NULL,
	  `region` varchar(255) DEFAULT NULL,
	  `address` text,
	  `lat` varchar(255) DEFAULT NULL,
	  `lng` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
");

$installer->endSetup();
