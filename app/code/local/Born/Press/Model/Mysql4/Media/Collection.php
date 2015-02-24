<?php
class Born_Press_Model_Mysql4_Media_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct() {  
       $this->_init('press/media');
    }  
}