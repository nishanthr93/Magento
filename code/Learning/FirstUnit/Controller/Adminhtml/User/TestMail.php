<?php

namespace Learning\FirstUnit\Controller\Adminhtml\User;

class TestMail extends \Magento\Backend\App\Action
{

	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
			$email = new \Zend_Mail();
			$email->setSubject("Feedback email");
			$email->setBodyHtml('<h1>HI This Demo</h1>');
			$email->setFrom('nishanthan@itflexsoluntions.com', 'nishan');
			$email->addTo('nishanthan257@gmail.com', 'nishan');
			$email->send();
        
        $this->messageManager->addSuccess(__('Mail Send Successfuly.'));
        return  $this->_redirect('usercontrol/user/index');
	}

}
