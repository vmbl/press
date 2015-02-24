<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
CREATE TABLE {$this->getTable('born_press')} (
	`id` int(11) unsigned NOT NULL auto_increment,
	`press_page_title` VARCHAR(255) NOT NULL,
	`issue_month` VARCHAR(100) NOT NULL,
	`sort_order` TINYINT(5) NULL,
	`press_cover_image` VARCHAR(255) NULL,
	`press_magazine_image` VARCHAR(255) NULL,
	PRIMARY KEY(id)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
 
$installer->endSetup();