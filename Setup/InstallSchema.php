<?php
/**
 * Landofcoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Landofcoder
 * @package    Lof_Opengraph
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
namespace Lof\Opengraph\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        if (!$setup->getConnection()->tableColumnExists($setup->getTable('cms_page'), 'og_title')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cms_page'),
                'og_title',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Open Graph page title'
                ]
            );
        }

        if (!$setup->getConnection()->tableColumnExists($setup->getTable('cms_page'), 'og_description')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cms_page'),
                'og_description',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'Open Graph page description'
                ]
            );
        }

        if (!$setup->getConnection()->tableColumnExists($setup->getTable('cms_page'), 'og_image')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cms_page'),
                'og_image',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Open Graph type image'
                ]
            );
        }

        if (!$setup->getConnection()->tableColumnExists($setup->getTable('cms_page'), 'og_type')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('cms_page'),
                'og_type',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 30,
                    'comment' => 'Open Graph type'
                ]
            );
        }

        $setup->endSetup();
    }
}
