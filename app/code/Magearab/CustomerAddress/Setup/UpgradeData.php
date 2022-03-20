<?php
/*
 * Copyright (c) Shaymaa Saied  16/03/2021, 15:45.
 */

namespace MageArab\CustomerAddress\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @param Config $eavConfig
     * @param EavSetupFactory $eavSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->eavConfig            = $eavConfig;
        $this->_eavSetupFactory     = $eavSetupFactory;
        $this->attributeSetFactory  = $attributeSetFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->startSetup();

            $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute('customer_address', 'building_no', [
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'Building Number',
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'system'=> false,
                'group'=> 'General',
                'global' => true,
                'visible_on_front' => true,
            ]);

            $customAttribute = $this->eavConfig->getAttribute('customer_address', 'building_no');

            $customAttribute->setData(
                'used_in_forms',
                ['adminhtml_customer_address','customer_address_edit','customer_register_address'] //list of forms where you want to display the custom attribute
            );
            $customAttribute->save();

            $eavSetup->addAttribute('customer_address', 'flat_no', [
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'Flat Number',
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'system'=> false,
                'group'=> 'General',
                'global' => true,
                'visible_on_front' => true,
            ]);

            $customAttribute = $this->eavConfig->getAttribute('customer_address', 'flat_no');

            $customAttribute->setData(
                'used_in_forms',
                ['adminhtml_customer_address','customer_address_edit','customer_register_address'] //list of forms where you want to display the custom attribute
            );
            $customAttribute->save();

            $eavSetup->addAttribute('customer_address', 'floor_no', [
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'Floor Number',
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'system'=> false,
                'group'=> 'General',
                'global' => true,
                'visible_on_front' => true,
            ]);

            $customAttribute = $this->eavConfig->getAttribute('customer_address', 'floor_no');

            $customAttribute->setData(
                'used_in_forms',
                ['adminhtml_customer_address','customer_address_edit','customer_register_address'] //list of forms where you want to display the custom attribute
            );
            $customAttribute->save();
            $setup->endSetup();
        }
    }
}