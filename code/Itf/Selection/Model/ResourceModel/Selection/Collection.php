<?php
 
namespace Itf\Selection\Model\ResourceModel\Selection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\Selection', 'Itf\Selection\Model\ResourceModel\Selection');
    }
}
