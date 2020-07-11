<?php

namespace Itf\Selection\Model;
 
use Magento\Framework\Model\AbstractModel;
use Itf\Selection\Api\Data\QuestionInterface;
 
class Question extends AbstractModel implements QuestionInterface
{
    const CACHE_TAG 		= 'is_question';
	protected $_cacheTag 	= 'is_question';
	protected $_eventPrefix = 'is_question';
 
    protected function _construct()
    {
        $this->_init('Itf\Selection\Model\ResourceModel\Question');
    }
    
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }
 
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }
 
    public function getSelectionId()
    {
        return $this->getData(self::SELECTION_ID);
    }
 
    public function setSelectionId($selectionId)
    {
        return $this->setData(self::SELECTION_ID, $selectionId);
    }
 
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }
 
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }
	
    public function getOptions()
    {
        return $this->getData(self::OPTIONS);
    }
 
    public function setOptions($options)
    {
        return $this->setData(self::OPTIONS, $options);
    }
 
    public function getChoices()
    {
        return $this->getData(self::CHOICES);
    }
 
    public function setChoices($choices)
    {
        return $this->setData(self::CHOICES, $choices);
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