<?php
namespace Learning\FirstUnit\Model;

class TableData extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{   
    const CACHE_TAG = 'test_table';

	protected $_cacheTag = 'test_table';

	protected $_eventPrefix = 'test_table';

    protected function _construct()
    {
    $this->_init('Learning\FirstUnit\Model\ResourceModel\TableData');
    }
    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}