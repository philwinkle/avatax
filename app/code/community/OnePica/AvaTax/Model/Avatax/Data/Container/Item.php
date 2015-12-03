<?php
/**
 * OnePica_AvaTax
 * NOTICE OF LICENSE
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
 * Class Item
 */
class OnePica_AvaTax_Model_Avatax_Data_Container_Item extends Varien_Object
{
    /**
     * Tax class id key
     */
    const TAX_CLASS_ID_KEY = 'product_tax_class_id';

    /**
     * UPC code key
     */
    const UPC_CODE_TAX = 'upc_code';

    /**
     * First reference value key
     */
    const FIRST_REFERENCE_KEY = 'first_reference';

    /**
     * Second reference value key
     */
    const SECOND_REFERENCE_KEY = 'second_reference';

    /**
     * Item data storage
     *
     * @var array
     */
    protected $_itemData = array();

    /**
     * Get item tax class id
     *
     * @return int|null
     */
    public function getTaxClassId()
    {
        return $this->_getData(self::TAX_CLASS_ID_KEY);
    }

    /**
     * Get UPC code
     *
     * @return string|null
     */
    public function getUpcCode()
    {
        return $this->_getData(self::UPC_CODE_TAX);
    }

    /**
     * Get first reference value
     *
     * @return string|null
     */
    public function getFirstReferenceValue()
    {
        return $this->_getData(self::FIRST_REFERENCE_KEY);
    }

    /**
     * Get second reference value
     *
     * @return string|null
     */
    public function getSecondReferenceValue()
    {
        return $this->_getData(self::SECOND_REFERENCE_KEY);
    }
}
