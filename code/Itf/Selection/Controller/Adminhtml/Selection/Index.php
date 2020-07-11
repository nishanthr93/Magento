<?php

namespace Itf\Selection\Controller\Adminhtml\Selection;
 
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_resultPageFactory;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) 
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }
 
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Itf_Selection::list');
        $resultPage->getConfig()->getTitle()->prepend(__('Product Selection List'));
 
        return $resultPage;
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Itf_Selection::list');
    }
}