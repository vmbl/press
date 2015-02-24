<?php

class Born_Press_Block_Adminhtml_Media_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'post',
			'enctype' => 'multipart/form-data',
			)
        );

        $form->setUseContainer(true);
        $this->setForm($form);
		
        $fieldset = $form->addFieldset('press_form', array(
            'legend'=>Mage::helper('press')->__('Press Section Info')
        ));

        $fieldset->addField('press_page_title', 'text', array(
            'name'      => 'press_page_title',
            'label'     => Mage::helper('press')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
        ));
		
		$fieldset->addField('issue_month', 'text', array(
            'name'      => 'issue_month',
            'label'     => Mage::helper('press')->__('Issue'),
            'note'      => Mage::helper('press')->__('Enter the month and year in the format - November, 2013'),
            'class'     => 'required-entry',
            'required'  => true,
        ));
		
        $fieldset->addField('sort_order', 'text', array(
            'name'      => 'sort_order',
            'label'     => Mage::helper('press')->__('Sort Order'),
            'note'      => Mage::helper('press')->__('Enter the sort order'),
        ));
		
		$fieldset->addType('image','Born_Press_Block_Adminhtml_Media_Edit_Form_Element_Image');
		
		$fieldset->addField('press_cover_image', 'image', array(
            'name'      => 'press_cover_image',
            'label'     => Mage::helper('press')->__('Thumbnail Image'),
			'required'  => false,
			'note'      => Mage::helper('press')->__('Upload Thumbnail Image! <br> Dimensions: 280 X 350'),
        ));
		
		$fieldset->addField('press_magazine_image', 'image', array(
            'name'      => 'press_magazine_image',
            'label'     => Mage::helper('press')->__('Main Image'),
			'required'  => false,
			'note'      => Mage::helper('press')->__('Upload Press Main Image!'),
        ));
		
        //Mage::dispatchEvent('press_adminhtml_edit_prepare_form', array('block'=>$this, 'form'=>$form));

        if (Mage::registry('press_data')) {
            $form->setValues(Mage::registry('press_data')->getData());
        }

        return parent::_prepareForm();
    }
}