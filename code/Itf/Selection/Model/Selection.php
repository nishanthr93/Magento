<?php

namespace Itf\Selection\Model;
 
use Magento\Framework\Model\AbstractModel;
use Itf\Selection\Api\Data\SelectionInterface;
 
class Selection extends AbstractModel implements SelectionInterface
{
    const CACHE_TAG 		= 'is_selection';
	protected $_cacheTag 	= 'is_selection';
	protected $_eventPrefix = 'is_selection';
 
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\ResourceModel\Selection');
    }
    
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }
 
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }
 
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }
 
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }
 
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }
 
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
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