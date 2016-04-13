<?php
/**
 * OnePica_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 * @copyright  Copyright (c) 2015 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * WEEE data helper
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Model_Weee_Data extends Mage_Weee_Helper_Data
{
    /**
     * Get weee amount display type on product view page
     *
     * @param   mixed $store
     * @return  int
     */
    public function getPriceDisplayType($store = null)
    {
        if ($this->_getDataHelper()->isAvatax16() && $this->_getDataHelper()->isServiceEnabled($store)) {
            return Mage_Weee_Model_Tax::DISPLAY_EXCL;
        }

        return parent::getPriceDisplayType($store);
    }

    /**
     * Get weee amount display type on product list page
     *
     * @param   mixed $store
     * @return  int
     */
    public function getListPriceDisplayType($store = null)
    {
        if ($this->_getDataHelper()->isAvatax16() && $this->_getDataHelper()->isServiceEnabled($store)) {
            return Mage_Weee_Model_Tax::DISPLAY_EXCL;
        }

        return parent::getListPriceDisplayType($store);
    }

    /**
     * Check if weee tax amount should be discounted
     *
     * @param   mixed $store
     * @return  bool
     */
    public function isDiscounted($store = null)
    {
        if ($this->_getDataHelper()->isAvatax16() && $this->_getDataHelper()->isServiceEnabled($store)) {
            return false;
        }

        return parent::isDiscounted($store);
    }

    /**
     * Check if weee tax amount should be taxable
     *
     * @param   mixed $store
     * @return  bool
     */
    public function isTaxable($store = null)
    {
        if ($this->_getDataHelper()->isAvatax16() && $this->_getDataHelper()->isServiceEnabled($store)) {
            return 0;
        }

        return parent::isTaxable($store);
    }

    /**
     * Get avatax data helper
     *
     * @return OnePica_AvaTax_Helper_Data
     */
    protected function _getDataHelper()
    {
        return Mage::helper('avatax');
    }
}

