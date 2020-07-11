<?php
namespace Learning\FirstUnit\Model\ResourceModel\TableData;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
    $this->_init(
        'Learning\FirstUnit\Model\TableData',
        'Learning\FirstUnit\Model\ResourceModel\TableData'
    );

    }
}