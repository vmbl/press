<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


/**
 * Customer Widget Form Image File Element Block
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Born_Press_Block_Adminhtml_Media_Edit_Form_Element_Image extends Varien_Data_Form_Element_Abstract
{

    public function __construct($data)
    {
        parent::__construct($data);
        $this->setType('file');
    }
	
	/*
	 * get the html for type image for store locator form
	 * @return html
	 */
    public function getElementHtml()
    {
        $html = '';

        if ($this->getValue()) {

            if( !preg_match("/^http\:\/\/|https\:\/\//", $this->getValue()) ) {
                $file = Mage::getBaseUrl('media') . 'born/press/' .$this->getValue();
            }

            $html = '<a onclick="imagePreview(\''.$this->getHtmlId().'_image\'); return false;" href="'.$file.'"><img id="'.$this->getHtmlId().'_image" class="small-image-preview v-middle" style="border: 1px solid #d6d6d6;" title="'.$this->getValue().'" src="'.$file.'" alt="'.$this->getValue().'" width="100"></a> 
			
			<span class="delete-image"><input type="checkbox" name="'.$this->getHtmlId().'[delete]" class="checkbox"' . ' id="' . $this->getHtmlId() . '_delete"' . ($this->getDisabled() ? ' disabled="disabled"': '') . '/><label for="' . $this->getHtmlId() . '_delete"'. ($this->getDisabled() ? ' class="disabled"' : '') . '>Delete Image</label><input type="hidden" name="'. $this->getHtmlId() .'[value]" value="' . $this->getValue() . '" /></span>
			';
        }
        $this->setClass('input-file');
        $html.= parent::getElementHtml();
		$html .= "<br/>";

        return $html;
    }
}
