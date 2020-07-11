<?php

namespace Learning\FirstUnit\Controller\Adminhtml\User;

use Magento\Framework\Controller\ResultFactory;
use Learning\FirstUnit\Model\ResourceModel\TableData\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    
    protected $filter;

   
    protected $_collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
         \Magento\Ui\Component\MassAction\Filter $filter,
        CollectionFactory $collectionFactory
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

     public function execute()
    {
        //die('delete');
       // echo 'hi';
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        // print_r($collection->getData());
        // die;
        foreach ($collection->getItems() as $record) {
            $record->setId($record->getId());
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

  
}
