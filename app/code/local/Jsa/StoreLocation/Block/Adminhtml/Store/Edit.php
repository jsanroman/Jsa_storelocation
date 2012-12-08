<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Block_Adminhtml_Store_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocation';
        $this->_controller = 'adminhtml_store';
        $this->_mode = 'edit';

        $this->_removeButton('delete');
        $this->_removeButton('reset');
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
    }

    public function getHeaderText()
    {
        return "Edit store";
    }
}