<?php

namespace Itf\Selection\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Model\AbstractModel;

class Userselection extends AbstractDb
{
    protected $_idFieldName = 'entity_id';
    protected $_date;
 
    public function __construct(
        Context $context,
        DateTime $date,
        $resourcePrefix = null
    ) 
    {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }
 
    protected function _construct()
    {
        $this->_init('is_user_selection', 'entity_id');
    }
	
	protected function _beforeSave(AbstractModel $object)
    {
        $object->setUpdatedAt($this->_date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->date());
        }
        return parent::_beforeSave($object);
    }
}