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
$this->startSetup();
$installer = new Mage_Sales_Model_Resource_Setup('core_setup');

$entities = array(
    'quote_item',
    'order_item'
);
$options = array(
    'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
    'visible'  => false,
    'required' => false
);
foreach ($entities as $entity) {
    $installer->addAttribute($entity, 'avatax_data', $options);
}
$installer->endSetup();
$this->endSetup();
