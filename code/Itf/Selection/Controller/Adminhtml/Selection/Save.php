<?php

namespace Itf\Selection\Controller\Adminhtml\Selection;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Itf\Selection\Helper\Data;

class Save extends Action
{
	protected $_helper;
	
	public function __construct(
		Data $helper,	
		Action\Context $context		  
	) 
	{
		parent::__construct($context);
		$this->_helper = $helper;
	}

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
		
        if (!$data) {
            $this->_redirect('selection/selection/add');
            return;
        }
		
        try {
			// Selection Action
			
            $rowData = $this->_objectManager->create('Itf\Selection\Model\Selection');
			
			$upload = $this->_helper->fileUpload('image', 'selection/title');
			if($upload) $data['image'] = $upload;
			
            $rowData->setData($data);
            if(isset($data['id'])){
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
			$insertId = $rowData->getId();
			
			// Question Action
			
			$questionCheck = $this->_objectManager->create('Itf\Selection\Model\Question')->getCollection()->addFieldToFilter('selection_id', array('eq' => $insertId));
			foreach($questionCheck as $item)
			{
				$item->setData(['entity_id' => $item->getEntityId(), 'status' => '2']);
			}
			$questionCheck->save();
					
			if(isset($data['questiondata']) && count($data['questiondata']) > 0){
				$questiondatas = $data['questiondata'];
				foreach($questiondatas as $questiondata){
					$questionModel 	= 	$this->_objectManager->create('Itf\Selection\Model\Question');
					$questionRecord = 	[
											'selection_id' 	=> $insertId,
											'question' 		=> $questiondata['question'],
											'options' 		=> $questiondata['options'],
											'choices' 		=> json_encode($questiondata['choices']),
											'status' 		=> '1'
										];
										
					if(isset($questiondata['id']) && $questiondata['id']!='') {
						$questionRecord['entity_id'] = $questiondata['id'];
					}
					
					$questionModel->setData($questionRecord);
					$questionModel->save();
				}
			}
			
            $this->messageManager->addSuccess(__('Product Selection has been successfully saved.'));
        } catch (Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
	
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Itf_Selection::save');
    }
}