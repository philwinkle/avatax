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
 * Class OnePica_AvaTax_Model_Avatax_Data_Container
 */
class OnePica_AvaTax_Model_Avatax_Data_Container
{
    /**
     * Items
     *
     * @var OnePica_AvaTax_Model_Avatax_Data_Container_Item[]
     */
    protected $_items = array();

    /**
     * Container initialization
     *
     * @param Mage_Sales_Model_Order_Item[]|Mage_Sales_Model_Quote_Item[] $items
     * @return $this
     */
    public function init($items)
    {
        foreach ($this->_getContainerTypes() as $containerType) {
            $this->_items = $this->_getContainerByType($containerType)->prepareItems($items)->getItems();

            if ($this->_items) {
                break;
            }
        }

        return $this;
    }

    /**
     * Get all items
     *
     * @return OnePica_AvaTax_Model_Avatax_Data_Container_Item[]
     */
    public function getAllItems()
    {
        return $this->_items;
    }

    /**
     * Get item by id
     *
     * @param int $id
     * @return null|OnePica_AvaTax_Model_Avatax_Data_Container_Item
     */
    public function getItemById($id)
    {
        return isset($this->_items[$id]) ? $this->_items[$id] : null;
    }

    /**
     * Get order item by object
     *
     * @param Mage_Core_Model_Abstract $item
     * @return Mage_Sales_Model_Order_Item|Mage_Sales_Model_Quote_Item
     */
    protected function _getItemByObject($item)
    {
        if ($item instanceof Mage_Sales_Model_Order_Invoice_Item
            || $item instanceof Mage_Sales_Model_Order_Creditmemo_Item
        ) {
            return $item->getOrderItem();
        }

        return $item;
    }

    /**
     * Get container by type
     *
     * @param string $type
     * @return OnePica_AvaTax_Model_Avatax_Data_Container_Type_Abstract
     */
    protected function _getContainerByType($type)
    {
        return Mage::getModel('avatax/avatax_data_container_type_' . $type);
    }

    /**
     * Get data providers name
     *
     * @return array
     */
    protected function _getContainerTypes()
    {
        return array(
            OnePica_AvaTax_Model_Avatax_Data_Container_Type_Field::CONTAINER_TYPE,
            OnePica_AvaTax_Model_Avatax_Data_Container_Type_Product::CONTAINER_TYPE
        );
    }
}
