<?php
/*
 * Copyright (c) Shaymaa Saied  05/06/2021, 00:55.
 */

namespace MageArab\CustomerAddress\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context )
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->startSetup();

            $connection = $setup->getConnection();
            $connection
                ->addColumn(
                    $setup->getTable('quote_address'),
                    'longitude',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                        'nullable' => true,
                        'default' => NULL,
                        'length' => 255,
                        'comment' => 'Longitude',
                        'after' => 'fax'
                    ]
                );
            $connection->addColumn(
                    $setup->getTable('quote_address'),
                    'latitude',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                        'nullable' => true,
                        'default' => NULL,
                        'length' => 255,
                        'comment' => 'Latitude',
                        'after' => 'fax'
                    ]
                );
            $connection
                ->addColumn(
                    $setup->getTable('sales_order_address'),
                    'latitude',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                        'nullable' => true,
                        'default' => NULL,
                        'length' => 255,
                        'comment' => 'Latitude',
                        'after' => 'fax'
                    ]
                );
            $connection->addColumn(
                    $setup->getTable('sales_order_address'),
                    'longitude',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                        'nullable' => true,
                        'default' => NULL,
                        'length' => 255,
                        'comment' => 'Longitude',
                        'after' => 'fax'
                    ]
                );

            $setup->endSetup();
        }

    }
}