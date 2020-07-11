<?php
namespace Learning\FirstUnit\Controller\Front;

class UpdateUser extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_postFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Learning\FirstUnit\Model\TableDataFactory $tabledataFactory	
	)
	{
		$this->_pageFactory = $pageFactory;
		$this->_postFactory = $tabledataFactory;
		 parent::__construct($context);
	}

	public function execute()
	{
		// $postData = $this->getRequest()->getParams();
		// print_r($postData);die;
		return $this->_pageFactory->create();
		

	}
}