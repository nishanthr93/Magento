<?php
namespace Learning\FirstUnit\Model\ResourceModel;
class TableData extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{   
    protected $_idFieldName = 'id';

    public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}

    protected function _construct()
    {
    $this->_init('test_table', 'id'); 
    }
}
