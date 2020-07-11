<?php

namespace Itf\Selection\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
		
		if(!$installer->tableExists('is_selection')){
			$table = $installer->getConnection()->newTable(
				$installer->getTable('is_selection')
			)
			->addColumn(
				'entity_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'nullable' => false, 'primary' => true],
				'Entity Id'
			)
			->addColumn(
				'title',
				Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Title'
			)
			->addColumn(
				'image',
				Table::TYPE_TEXT,
				255,
				[],
				'Image'
			)
			->addColumn(
				'status',
				Table::TYPE_SMALLINT,
				null,
				[],
				'Status'
			)
			->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Created At'
			)
			->addColumn(
				'created_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Created By'
			)
			->addColumn(
				'updated_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Updated At'
			)
			->addColumn(
				'updated_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Updated By'
			)
			->setComment(
				'Selection Table'
			);
	 
			$installer->getConnection()->createTable($table);
		}
		
		if(!$installer->tableExists('is_question')){
			$table = $installer->getConnection()->newTable(
				$installer->getTable('is_question')
			)
			->addColumn(
				'entity_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'nullable' => false, 'primary' => true],
				'Entity Id'
			)
			->addColumn(
				'selection_id',
				Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Selection Id'
			)
			->addColumn(
				'question',
				Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Question'
			)
			->addColumn(
				'options',
				Table::TYPE_SMALLINT,
				null,
				['nullable' => false],
				'Options'
			)
			->addColumn(
				'choices',
				Table::TYPE_TEXT,
				'2M',
				['nullable' => false],
				'Choices'
			)
			->addColumn(
				'status',
				Table::TYPE_SMALLINT,
				null,
				[],
				'Status'
			)
			->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Created At'
			)
			->addColumn(
				'created_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Created By'
			)
			->addColumn(
				'updated_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Updated At'
			)
			->addColumn(
				'updated_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Updated By'
			)
			->setComment(
				'Question Table'
			);
	 
			$installer->getConnection()->createTable($table);
		}
		
		if(!$installer->tableExists('is_user_selection')){
			$table = $installer->getConnection()->newTable(
				$installer->getTable('is_user_selection')
			)
			->addColumn(
				'entity_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'nullable' => false, 'primary' => true],
				'Entity Id'
			)
			->addColumn(
				'user_id',
				Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'User Id'
			)
			->addColumn(
				'selection_id',
				Table::TYPE_INTEGER,
				null,
				['nullable' => false],
				'Selection Id'
			)
			->addColumn(
				'selection',
				Table::TYPE_TEXT,
				'2M',
				['nullable' => false],
				'Selection'
			)
			->addColumn(
				'status',
				Table::TYPE_SMALLINT,
				null,
				[],
				'Status'
			)
			->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Created At'
			)
			->addColumn(
				'created_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Created By'
			)
			->addColumn(
				'updated_at',
				Table::TYPE_TIMESTAMP,
				null,
				[],
				'Updated At'
			)
			->addColumn(
				'updated_by',
				Table::TYPE_INTEGER,
				null,
				[],
				'Updated By'
			)
			->setComment(
				'User Selection Table'
			);
	 
			$installer->getConnection()->createTable($table);
		}
		
        $installer->endSetup();
    }
}