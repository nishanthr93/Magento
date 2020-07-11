<?php

namespace Itf\Selection\Api\Data;
 
interface SelectionInterface
{
    const ENTITY_ID 	= 'entity_id';
    const TITLE 		= 'title';
    const IMAGE 		= 'image';
    const STATUS 		= 'status';
    const CREATED_AT 	= 'created_at';
    const CREATED_BY 	= 'created_by';
    const UPDATED_AT 	= 'updated_at';
    const UPDATED_BY 	= 'updated_by';
 
    public function getEntityId();
    public function setEntityId($entityId);
 
    public function getTitle();
    public function setTitle($title);
 
    public function getImage();
    public function setImage($image);
 
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