<?php
/**
 * @category    Jsa
 * @package     Jsa_StoreLocation
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Javi Sanromán <javisanroman@gmail.com>
 */

class Jsa_StoreLocation_Model_Mysql4_Store extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('storelocation/store', 'id');
    }
}
