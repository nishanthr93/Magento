<?php

namespace Itf\Selection\Model;
 
use Magento\Framework\Model\AbstractModel;
use Itf\Selection\Api\Data\UserselectionInterface;
 
class Userselection extends AbstractModel implements UserselectionInterface
{
    const CACHE_TAG 		= 'is_user_selection';
	protected $_cacheTag 	= 'is_user_selection';
	protected $_eventPrefix = 'is_user_selection';
 
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\ResourceModel\Userselection');
    }
    
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }
 
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }
 
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }
 
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }
 
    public function getSelectionId()
    {
        return $this->getData(self::SELECTION_ID);
    }
 
    public function setSelectionId($selectionId)
    {
        return $this->setData(self::SELECTION_ID, $selectionId);
    }
 
    public function getSelection()
    {
        return $this->getData(self::SELECTION);
    }
 
    public function setSelection($selection)
    {
        return $this->setData(self::SELECTION, $selection);
    }
 
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }
 
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
 
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
 
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
    
    public function getCreatedBy()
    {
        return $this->getData(self::CREATED_BY);
    }
 
    public function setCreatedBy($createdBy)
    {
        return $this->setData(self::CREATED_BY, $createdBy);
    }
    
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
 
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
	
    public function getUpdatedBy()
    {
        return $this->getData(self::UPDATED_BY);
    }
 
    public function setUpdatedBy($updatedBy)
    {
        return $this->setData(self::UPDATED_BY, $updatedBy);
    }
}