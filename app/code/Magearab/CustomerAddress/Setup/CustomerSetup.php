<?php

namespace MageArab\CustomerAddress\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class CustomerSetup extends EavSetup {

	protected $eavConfig;

	public function __construct(
		ModuleDataSetupInterface $setup,
		Context $context,
		CacheInterface $cache,
		CollectionFactory $attrGroupCollectionFactory,
		Config $eavConfig
		) {
		$this -> eavConfig = $eavConfig;
		parent :: __construct($setup, $context, $cache, $attrGroupCollectionFactory);
	}

	public function installAttributes($customerSetup) {
		$this -> installCustomerAttributes($customerSetup);
		$this -> installCustomerAddressAttributes($customerSetup);
	}

	public function installCustomerAttributes($customerSetup) {
			
	}

	public function installCustomerAddressAttributes($customerSetup) {
			

		$customerSetup -> addAttribute('customer_address',
			'longitude',
			[
			'label' => 'Longitude',
			'system' => 0,
			'user_defined' => true,
			'position' => 200,
            'sort_order' =>200,
            'visible' =>  true,
			'default_value' => '',
			'note' => '',
				

                        'type' => 'varchar',
                        'input' => 'text',
			
			]
			);

		$customerSetup -> getEavConfig() -> getAttribute('customer_address', 'longitude')->setData('is_user_defined',1)->setData('default_value','')-> setData('used_in_forms', ['adminhtml_customer_address', 'customer_register_address', 'customer_address_edit']) -> save();

				

		$customerSetup -> addAttribute('customer_address',
			'latitude',
			[
			'label' => 'Latitude',
			'system' => 0,
			'user_defined' => true,
			'position' => 250,
            'sort_order' =>250,
            'visible' =>  true,
			'default_value' => '',
			'note' => '',
				

                        'type' => 'varchar',
                        'input' => 'text',
			
			]
			);

		$customerSetup -> getEavConfig() -> getAttribute('customer_address', 'latitude')->setData('is_user_defined',1)->setData('default_value','')-> setData('used_in_forms', ['adminhtml_customer_address', 'customer_register_address', 'customer_address_edit']) -> save();

				

		$customerSetup -> addAttribute('customer_address',
			'phone_code',
			[
			'label' => 'Phone Code',
			'system' => 0,
			'user_defined' => true,
			'position' => 150,
            'sort_order' =>150,
            'visible' =>  true,
			'default_value' => '',
			'note' => '',
				

                        'type' => 'varchar',
                        'input' => 'text',
			
			]
			);

		$customerSetup -> getEavConfig() -> getAttribute('customer_address', 'phone_code')->setData('is_user_defined',1)->setData('default_value','')-> setData('used_in_forms', ['adminhtml_customer_address', 'customer_register_address', 'customer_address_edit']) -> save();

				
	}

	public function getEavConfig() {
		return $this -> eavConfig;
	}
} 