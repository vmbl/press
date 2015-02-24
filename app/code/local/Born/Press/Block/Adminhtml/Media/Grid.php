<?phpclass Born_Press_Block_Adminhtml_Media_Grid extends Mage_Adminhtml_Block_Widget_Grid{    public function __construct() {        parent::__construct();        $this->setId('press_grid');        $this->setDefaultSort('id');        $this->setDefaultDir('asc');        $this->setSaveParametersInSession(true);    }	    protected function _prepareCollection() {        $collection = Mage::getModel('press/media')->getCollection();        $this->setCollection($collection);        return parent::_prepareCollection(); 	}	    protected function _prepareColumns() {    	$this->addColumn('id', array(            'header'    => Mage::helper('press')->__('Id'),            'align'     =>'left',            'index'     => 'id',        ));				$this->addColumn('press_page_title', array(            'header'    => Mage::helper('press')->__('Magazine Title'),            'align'     =>'left',            'index'     => 'press_page_title',        ));				$this->addColumn('issue_month', array(            'header'    => Mage::helper('press')->__('Issue'),            'align'     =>'left',            'index'     => 'issue_month',        ));		       return parent::_prepareColumns();	     }	    public function getRowUrl($row) {        return $this->getUrl('*/*/edit', array('id' => $row->getId()));    }}