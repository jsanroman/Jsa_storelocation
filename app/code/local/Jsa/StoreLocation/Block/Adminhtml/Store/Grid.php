<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Block_Adminhtml_Store_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('id');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('storelocation/Store')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $storeModel  = Mage::getModel('storelocation/Store');

        $this->addColumn('id', array(
            'header'    => Mage::helper('storelocation')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'id',
        ));

        $this->addColumn('isocode2', array(
            'header'    => Mage::helper('cmsplus')->__('Country'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'isocode2',
            'type'      => 'options',
            'options'    => $storeModel->getCountriesCodes(),
        ));

        $this->addColumn('region', array(
            'header'    => Mage::helper('storelocation')->__('Region'),
            'align'     =>'left',
            'index'     => 'region',
        ));

         $this->addColumn('address', array(
            'header'    => Mage::helper('storelocation')->__('Address'),
            'align'     =>'left',
            'index'     => 'address',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('storelocation')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('storelocation')->__('Are you sure?')
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}