<?php
class Born_Press_Block_Media extends Mage_Core_Block_Template {
		
	public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('press/media')->getCollection();
        $this->setCollection($collection);
    }
 
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
		
        $pager = $this->getLayout()->createBlock('page/html_pager');
		$itemsPerPage			=	 	Mage::getStoreConfig('press/press_group/press_input',Mage::app()->getStore());
		$itemsPerPagearray  	=		explode(',',$itemsPerPage);
		foreach($itemsPerPagearray as $value){
			$setPageValue[$value] = $value;
		}
        $pager->setAvailableLimit($setPageValue);
		$pager->setShowAmounts(true)
			  ->setUseContainer(true);
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }
 
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
