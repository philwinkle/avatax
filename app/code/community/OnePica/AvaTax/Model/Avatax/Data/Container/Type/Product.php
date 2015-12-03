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
 * Class OnePica_AvaTax_Model_Avatax_Data_Item_DataProvider_Product
 */
class OnePica_AvaTax_Model_Avatax_Data_Container_Type_Product
    extends OnePica_AvaTax_Model_Avatax_Data_Container_Type_Abstract
{
    /**
     * Container type
     */
    const CONTAINER_TYPE = 'product';

    /**
     * Product collection
     *
     * @var Mage_Catalog_Model_Resource_Product_Collection
     */
    protected $_productCollection;

    /**
     * Prepare items
     *
     * @param Mage_Sales_Model_Order_Item[]|Mage_Sales_Model_Quote_Item[] $items
     * @return mixed
     */
    public function prepareItems($items)
    {
        $this->_initProductCollection($items);

        foreach ($items as $item) {
            $item = $this->_getOrderItemByObject($item);
            $this->_addItem($item);
        }

        return $this;
    }

    /**
     * Init product collection for items to be calculated
     *
     * @param Mage_Sales_Model_Order_Item[]|Mage_Sales_Model_Quote_Item[] $items
     * @return $this
     */
    protected function _initProductCollection($items)
    {
        $productIds = array();
        $storeId = null;
        foreach ($items as $item) {
            $productIds[] = $item->getProductId();
            if (!$storeId) {
                $storeId = $item->getStoreId();
            }
        }

        $this->_productCollection = Mage::getModel('catalog/product')
            ->getCollection()
            ->setStoreId($storeId)
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('entity_id', array('in' => $productIds));

        return $this;
    }

    /**
     * Add item
     *
     * @param Mage_Sales_Model_Order_Item|Mage_Sales_Model_Quote_Item $item
     * @return $this
     */
    protected function _addItem($item)
    {
        $product = $this->_productCollection->getItemById($item->getProductId());

        if (null !== $product) {
            $this->_items[$item->getId()] = $this->_getItemModel()->setData(
                $this->_getDataHelper()->prepareAvataxData($product)
            );
        }

        return $this;
    }

    /**
     * Get data helper
     *
     * @return OnePica_AvaTax_Helper_Data
     */
    protected function _getDataHelper()
    {
        return Mage::helper('avatax');
    }
}
