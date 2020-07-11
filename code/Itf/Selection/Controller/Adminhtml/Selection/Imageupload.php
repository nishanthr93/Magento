<?php

namespace Itf\Selection\Controller\Adminhtml\Selection;

use Magento\Backend\App\Action;
use Itf\Selection\Helper\Data;

class Imageupload extends Action
{
	protected $_helper; 
	
	public function __construct(
		Action\Context $context,
		Data $helper
	) 
	{
		parent::__construct($context);
		$this->_helper = $helper;
	}

    public function execute()
    {
		$result = ['status' => '0'];
		
		$upload = $this->_helper->fileUpload('image', 'selection/question');
		if($upload){
			$result = ['status' => '1', 'file' => $upload];
		}
		
		return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);		
    }
}