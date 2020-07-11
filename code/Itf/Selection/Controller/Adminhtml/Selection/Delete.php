<?php

namespace Itf\Selection\Controller\Adminhtml\Selection;
 
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Itf\Selection\Model\Selection;
 
class Delete extends Action
{
    protected $_model;
 
    public function __construct(
        Context $context,
        Selection $model
    ) 
	{
        parent::__construct($context);
        $this->_model = $model;
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Product Selection deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Product Selection does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
	
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Itf_Selection::delete');
    }
}