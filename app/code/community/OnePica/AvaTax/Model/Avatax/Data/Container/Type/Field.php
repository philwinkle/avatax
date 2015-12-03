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
 * Class OnePica_AvaTax_Model_Avatax_Data_Container_Type_Field
 */
class OnePica_AvaTax_Model_Avatax_Data_Container_Type_Field
    extends OnePica_AvaTax_Model_Avatax_Data_Container_Type_Abstract
{
    /**
     * Container type
     */
    const CONTAINER_TYPE = 'field';

    /**
     * Avatax data field
     */
    const DATA_FILED = 'avatax_data';

    /**
     * Prepare items
     *
     * @param Mage_Sales_Model_Order_Item[]|Mage_Sales_Model_Quote_Item[] $items
     * @return $this
     */
    public function prepareItems($items)
    {
        foreach ($items as $item) {
            $item = $this->_getOrderItemByObject($item);

            if (!$item->getData(self::DATA_FILED)) {
                continue;
            }

            $this->_addItem($item);
        }

        return $this;
    }

    /**
     * Add item
     *
     * @param Mage_Sales_Model_Quote_Item|Mage_Sales_Model_Order_Item $item
     * @return $this
     */
    protected function _addItem($item)
    {
        $data = unserialize($item->getData(self::DATA_FILED));
        if ($data !== false) {
            $this->_items[$item->getId()] = $this->_getItemModel()->setData($data);
        }

        return $this;
    }
}
