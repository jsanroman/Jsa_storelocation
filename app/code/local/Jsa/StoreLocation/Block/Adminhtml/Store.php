<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Block_Adminhtml_Store extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_store';
        $this->_blockGroup = 'storelocation';
        $this->_headerText = Mage::helper('storelocation')->__('Stores');
        $this->_addButtonLabel = Mage::helper('storelocation')->__('Add store');
        parent::__construct();
    }
}