<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Model_Store extends Mage_Core_Model_Abstract 
{

    public function _construct() 
    {
        parent::_construct();
        $this->_init('storelocation/store');
    }

    public function getCountries () 
    {
        $countries = Mage::getModel('storelocation/store')->getCollection();
        $countries->getSelect()->group('isocode2');

        return $countries;
    }

    public function getRegions($country_iso) 
    {
        $regions = Mage::getModel('storelocation/store')->getCollection()
            ->addFilter('isocode2', $country_iso);
        $regions->getSelect()->group('region');

        return $regions;
    }

    public function getStores($country_iso, $region) 
    {
        $stores = Mage::getModel('storelocation/store')->getCollection()
            ->addFilter('isocode2', $country_iso)
            ->addFilter('region', $region);

        return $stores;
    }


    public function getCountriesCodes() 
    {
        $countries_codes = array();

        $countries = Mage::getResourceModel('directory/country_collection')->load()->toOptionArray();

        foreach ($countries as $country) {
            $countries_codes[$country['value']] = $country['label'];
        }

        return $countries_codes;
    }
}
