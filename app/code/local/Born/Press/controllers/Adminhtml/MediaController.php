<?php

class Born_Press_Adminhtml_MediaController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
		$this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('press/adminhtml_media'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('press/media');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('press')->__('No Press Issue Found!'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('press_data', $model);
		
		$this->loadLayout();
		
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('press/adminhtml_media_edit'));
			
        $this->renderLayout();
    }

    /*
	 * add new press issue
	*/	
	public function saveAction() {
		try {

			$press_data = $this->getRequest()->getPost();
			 
			if( ! empty($press_data))
			{
				//set the press data
				if( empty($press_data['press_page_title']) || empty($press_data['issue_month'] ))
					throw new Exception(__('Please enter required fields'));
				
				//populate image data
				if (isset($_FILES))  {
					foreach ($_FILES as $fileKey => $fileValue) {
						if (!array_key_exists('delete', $press_data[$fileKey]))  {
							$fileNames[] = $fileValue['name'];
							if ($_FILES[$fileKey]['name'] != null)  {
								foreach( $fileNames as $nameKey => $nameValue)  {
									try {
										$uploader = new Varien_File_Uploader($fileKey);
										$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
										
										$uploader->setAllowRenameFiles(true);
										$uploader->setFilesDispersion(false);
										
										$path = Mage::getBaseDir('media') . DS . 'born/press/' ;
										
										$image_name = $uploader->save($path, $_FILES[$fileKey]['name']);
										
										$press_data[$fileKey] = $image_name['file'];
									}
									catch(Exception $e) {
										//throw new Exception($e->getMessage());
									}
								}
							}
							else {
								//if($press_data[$fileKey]['value'] != null) {
									//$press_data[$fileKey] = $press_data[$fileKey]['value'];
								//}
								unset($press_data[$fileKey]);
							}
						}
						else  {
							$press_data[$fileKey] = '';
						}
					}
				}
				
				//load the press model
				$press_model = Mage::getModel('press/media');
				$press_id = $this->getRequest()->getParam('id');
				
				//set press id and load it if it is an update
				$press_model->setData($press_data);
				
				if( !empty($press_id)) {
					$press_model->setId($press_id);
				}

				Mage::getSingleton('adminhtml/session')->setFormData($press_data);

				$press_model->save();
				
				if( !$press_model->getId()) {
					throw new Exception('Error Saving Press Issue');
				}
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('press')->__('Press Issue Saved Successfully'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
 
				// The following line decides if it is a "save" or "save and continue"
				if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $press_model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
			}
			
		}
		catch(Exception $e) {
			Mage::getSingleton('adminhtml/session')->addError(__($e->getMessage()));
			if ($press_model && $press_model->getId()) {
				$this->_redirect('*/*/edit', array('id' => $press_model->getId()));
			} else {
				$this->_redirect('*/*/');
			}
		}
	}

    public function deleteAction() {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('press/media');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('press')->__('Press Issue has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find the press issue to delete.'));
        $this->_redirect('*/*/');
	}
}