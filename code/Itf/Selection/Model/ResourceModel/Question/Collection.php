<?php
 
namespace Itf\Selection\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\Question', 'Itf\Selection\Model\ResourceModel\Question');
    }
}
