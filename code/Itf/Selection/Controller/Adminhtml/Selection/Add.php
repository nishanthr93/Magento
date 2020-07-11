<?php

namespace Itf\Selection\Controller\Adminhtml\Selection;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;

class Add extends Action
{
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) 
    {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
    }
   
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->_objectManager->create('Itf\Selection\Model\Selection');
        
        if ($rowId) {
            $collection		= 	$rowData
								->getCollection()
								->addFieldToFilter('main_table.entity_id', array('eq'=>$rowId));
							
			$collection
			->getSelect()
			->reset(\Zend_Db_Select::COLUMNS)
			->columns([
				'main_table.entity_id', 
				'main_table.title', 
				'main_table.image', 
				'main_table.status', 
				'main_table.created_at', 
				'main_table.updated_at',
				'questiondata' => new \Zend_Db_Expr('GROUP_CONCAT(CONCAT_WS("@@@", qd.entity_id, qd.question, qd.options, qd.choices) SEPARATOR "@_@")')
			])
			->joinLeft(
				['qd' => 'is_question'],
				'main_table.entity_id = qd.selection_id and qd.status = "1"',
				[]
			)
			->group('main_table.entity_id');
			
            $rowData 	= $collection->getFirstItem();

            $rowTitle 	= $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('Product Selection data no longer exist.'));
                $this->_redirect('selection/selection/index');
                return;
            }
        }
 
        $this->_coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Product Selection ').$rowTitle : __('Add Product Selection');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
	
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Itf_Selection::add');
    }
}