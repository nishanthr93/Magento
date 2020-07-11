<?php

namespace Itf\Selection\Api\Data;
 
interface UserselectionInterface
{
    const ENTITY_ID 	= 'entity_id';
    const USER_ID 		= 'user_id';
    const SELECTION_ID 	= 'selection_id';
    const SELECTION 	= 'selection';
    const STATUS 		= 'status';
    const CREATED_AT 	= 'created_at';
    const CREATED_BY 	= 'created_by';
    const UPDATED_AT 	= 'updated_at';
    const UPDATED_BY 	= 'updated_by';
 
    public function getEntityId();
    public function setEntityId($entityId);
 
    public function getUserId();
    public function setUserId($userId);
 
    public function getSelectionId();
    public function setSelectionId($selectionId);
 
    public function getSelection();
    public function setSelection($selection);
 
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