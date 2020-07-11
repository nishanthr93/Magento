<?php
namespace Learning\FirstUnit\Controller\Front;

class Demo extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_postFactory;
	protected $inlineTranslation;
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Learning\FirstUnit\Model\TableDataFactory $tabledataFactory,
		\Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
	)
	{
		$this->_pageFactory = $pageFactory;
		$this->_postFactory = $tabledataFactory;
		$this->inlineTranslation = $inlineTranslation;
		 parent::__construct($context);
	}

	public function execute()
	{
		// $email = new \Zend_Mail();
		// $email->setSubject("Feedback email");
		// $email->setBodyText('test text');
		// $email->setFrom('nishanthan@itflexsoluntions.com', 'nishan');
		// $email->addTo('nnnishakutty@gmail.com', 'nishan');
		// $email->send();
		return $this->_pageFactory->create();

	}
}