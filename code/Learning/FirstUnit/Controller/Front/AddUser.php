<?php
namespace Learning\FirstUnit\Controller\Front;
use Learning\FirstUnit\Model\TableDataFactory;

class AddUser extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_model;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		TableDataFactory $model        
	)
	{	
		$this->_model = $model;
		$this->_pageFactory = $pageFactory;
		 parent::__construct($context);
	}

	public function execute()
	{
        return $this->_pageFactory->create();
	}
	
}