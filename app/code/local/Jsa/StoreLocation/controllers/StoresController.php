<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_StoresController extends Mage_Core_Controller_Front_Action 
{

    public function indexAction() 
    {
		$countries = Mage::getModel('storelocation/store')->getCountries();
		foreach ($countries as $country) {
			$country_name = Mage::getResourceModel('directory/country_collection')->addCountryCodeFilter($country->getIsocode2())->load()->toOptionArray();
			$country->name = $country_name[1]['label'];
		}

		Mage::register('countries', $countries);

		$regions = Mage::getModel('storelocation/store')->getRegions($countries->getFirstItem()->getIsocode2());
		Mage::register('regions', $regions);

		$this->loadLayout()->renderLayout();
    }

    public function regionsAction() {

		$regions = Mage::getModel('storelocation/store')->getRegions($this->getRequest()->getParam('countryIso'));

		Mage::register('regions', $regions);

    	$this->loadLayout()->renderLayout();
    }

    public function storesAction() {

		$stores = Mage::getModel('storelocation/store')->getStores($this->getRequest()->getParam('countryIso'), $this->getRequest()->getParam('region'));

		Mage::register('stores', $stores);

    	$this->loadLayout()->renderLayout();
    }
}