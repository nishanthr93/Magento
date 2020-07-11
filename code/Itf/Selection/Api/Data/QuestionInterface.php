<?php

namespace Itf\Selection\Api\Data;
 
interface QuestionInterface
{
    const ENTITY_ID 	= 'entity_id';
    const SELECTION_ID 	= 'selection_id';
    const QUESTION 		= 'question';
    const OPTIONS 		= 'options';
    const CHOICES 		= 'choices';
    const STATUS 		= 'status';
    const CREATED_AT 	= 'created_at';
    const CREATED_BY 	= 'created_by';
    const UPDATED_AT 	= 'updated_at';
    const UPDATED_BY 	= 'updated_by';
 
    public function getEntityId();
    public function setEntityId($entityId);
 
    public function getSelectionId();
    public function setSelectionId($selectionId);
 
    public function getQuestion();
    public function setQuestion($question);
 
    public function getOptions();
    public function setOptions($options);
 
    public function getChoices();
    public function setChoices($choices);
 
    public function getStatus();
    public function setStatus($status);
 
    public function getCreatedAt();
    public function setCreatedAt($createdAt);
	
    public function getCreatedBy();
    public function setCreatedBy($createdBy);
	
    public function getUpdatedAt();
    public function setUpdatedAt($updatedAt);
	
    public function getUpdatedBy();
    public function setUpdatedBy($updatedBy);
}