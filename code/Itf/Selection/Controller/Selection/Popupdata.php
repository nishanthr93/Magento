<?php

namespace Itf\Selection\Controller\Selection;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Itf\Selection\Block\Selection as Selectionblock;

class Popupdata extends Action
{
	protected $jsonFactory;
	protected $selection;
	
	public function __construct(
		Context $context,
		JsonFactory $jsonFactory,
		Selectionblock $Selectionblock
	) 
	{
		parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
		$this->selection = $Selectionblock;
	}

    public function execute()
    {
		$resultJson = $this->jsonFactory->create();
        
        return $resultJson->setData([
            'status' 	=> '1',
            'result' 	=> $this->selection->getSessionSelection()
        ]);
    }
}