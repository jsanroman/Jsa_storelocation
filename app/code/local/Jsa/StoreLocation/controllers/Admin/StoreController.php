<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Admin_StoreController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
		$this->loadLayout();
		$this->_setActiveMenu('storelocation_index');
        $this->renderLayout();
    }

    public function editAction() {
		$this->loadLayout();
		$this->_setActiveMenu('storelocation_index');

        $storeId = $this->getRequest()->getParam('id');

        if($storeId) {
	        $storeModel  = Mage::getModel('storelocation/Store')->load($storeId);
			Mage::register('store_data', $storeModel);
		}

        $this->renderLayout();
    }

    public function newAction() {
		$this->loadLayout();
		$this->_setActiveMenu('storelocation_index');
        $this->renderLayout();
    }

	public function saveAction()
    {
		if( $data = $this->getRequest()->getPost() ) {

			$id = $this->getRequest()->getParam('id');

			if($id && $id>0) {
				$store = Mage::getModel('storelocation/Store')->load($id);
			} else {

				$store = Mage::getModel('storelocation/Store');
			}

			$store->setData($data)->setId($id);

			$store->save();

			Mage::getSingleton('adminhtml/session')->addSuccess('Tienda guardada correctamente');
			$this->_redirect('*/*/index');
		} else {
			$this->_redirect('*/*/edit');
		}
	}

	public function massDeleteAction() {

		if( $ids = $this->getRequest()->getPost('id') ) {
			foreach ($ids as $id) {
				$store = Mage::getModel('storelocation/Store')->load($id);
				$store->delete();
			}
		}

		$this->_redirect('*/*/index');
	}
}