<?php
$installer = $this;

$installer->startSetup();

$table_quote = $this->getTable('born_press');
$installer->run("ALTER TABLE  {$this->getTable('born_press')} 
					ADD COLUMN `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    				ADD COLUMN `update_date` TIMESTAMP NULL"
			   );

$installer->endSetup();