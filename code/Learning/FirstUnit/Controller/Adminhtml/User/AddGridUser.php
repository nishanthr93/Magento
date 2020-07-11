<?php

namespace Learning\FirstUnit\Controller\Adminhtml\User;

use Magento\Framework\Controller\ResultFactory;

class AddGridUser extends \Magento\Backend\App\Action
{
    private $coreRegistry;

    private $TableDataFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Learning\FirstUnit\Model\TableDataFactory $TableDataFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->TableDataFactory = $TableDataFactory;
    }


    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');

        $rowData = $this->TableDataFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();
           if (!$rowData->getId()) {
               $this->messageManager->addError(__('row data no longer exist.'));
               $this->_redirect('grid/grid/rowdata');
               return;
           }
       }

       $this->coreRegistry->register('data_row', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $title = $rowId ? __('Edit User Data ').$rowTitle : __('Add Row user');
       $resultPage->getConfig()->getTitle()->prepend($title);
       return $resultPage;
    }
}