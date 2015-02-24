<?php
class Born_Press_Block_Adminhtml_Media extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected $_addButtonLabel = 'Add New Press Issue';
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_media';
        $this->_blockGroup = 'press';
        $this->_headerText = Mage::helper('press')->__('Press');
    }
}
?>
 
 
