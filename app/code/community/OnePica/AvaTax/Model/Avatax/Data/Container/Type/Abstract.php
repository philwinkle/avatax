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
 * Class OnePica_AvaTax_Model_Avatax_Data_Container_Type_Abstract
 */
abstract class OnePica_AvaTax_Model_Avatax_Data_Container_Type_Abstract
{
    /**
     * Items
     *
     * @var OnePica_AvaTax_Model_Avatax_Data_Container_Item[]
     */
    protected $_items = array();

    /**
     * Prepare items
     *
     * @param Mage_Sales_Model_Order_Item[]|Mage_Sales_Model_Quote_Item[] $items
     * @return $this
     */
    abstract public function prepareItems($items);

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * Get container item model
     *
     * @return OnePica_AvaTax_Model_Avatax_Data_Container_Item
     */
    protected function _getItemModel()
    {
        return Mage::getModel('avatax/avatax_data_container_item');
    }

    /**
     * Get order item by object
     *
     * @param Mage_Core_Model_Abstract $item
     * @return Mage_Sales_Model_Order_Item|Mage_Sales_Model_Quote_Item
     */
    protected function _getOrderItemByObject($item)
    {
        if ($item instanceof Mage_Sales_Model_Order_Invoice_Item
            || $item instanceof Mage_Sales_Model_Order_Creditmemo_Item
        ) {
            return $item->getOrderItem();
        }

        return $item;
    }
}
