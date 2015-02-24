<?php
class Born_Press_Block_Adminhtml_Media_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct() {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'press';
        $this->_controller = 'adminhtml_media';
        $this->_mode = 'edit';
        $this->_updateButton('save', 'label', Mage::helper('press')->__('Save Press Issue'));
		
		$this->_addButton('save_and_continue', array(
                  'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                  'onclick' => 'saveAndContinueEdit()',
                  'class' => 'save',
        ), -100);
 
         $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }
 
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
	}
	
    public function getHeaderText() {
        if (Mage::registry('press_data') && Mage::registry('press_data')->getId()) {
            return Mage::helper('press')->__('Edit Press Content - %s', $this->htmlescape(Mage::registry('press_data')->getPressPageTitle()));
        } 
	    else {	
            return Mage::helper('press')->__('New Issue');
	    }
    }
}
 