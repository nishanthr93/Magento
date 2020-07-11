<?php
 
namespace Itf\Selection\Model\ResourceModel\Userselection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\Userselection', 'Itf\Selection\Model\ResourceModel\Userselection');
    }
}
