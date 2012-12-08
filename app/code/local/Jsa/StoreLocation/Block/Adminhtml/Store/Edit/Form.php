<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Block_Adminhtml_Store_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $storeModel  = Mage::getModel('storelocation/Store');

        if (Mage::registry('store_data')) {
            $data = Mage::registry('store_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post'
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('general', array(
             'legend' =>Mage::helper('cmsplus')->__('General')
        ));
 
        $fieldset->addField('isocode2', 'select', array(
          'label'     => Mage::helper('storelocation')->__('Country'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'isocode2',
          'value'  => 1,
          'values' =>  $storeModel->getCountriesCodes(),
          'tabindex' => 1
        ));
 
        $fieldset->addField('region', 'text', array(
          'label'     => Mage::helper('storelocation')->__('Region'),
          'required'  => true,
          'name'      => 'region'
        ));

        $fieldset->addField('address', 'textarea', array(
            'label' => Mage::helper('cmsplus')->__('Address'),
            'name'  => 'address'
        ));

        $fieldset->addField('lat', 'text', array(
            'label'     => Mage::helper('storelocation')->__('Lat'),
            'required'  => true,
            'name'      => 'lat'
        ));

        $fieldset->addField('lng', 'text', array(
            'label'     => Mage::helper('storelocation')->__('Lng'),
            'required'  => true,
            'name'      => 'lng'
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }
}