<?php
namespace Learning\FirstUnit\Controller\Front;

use Learning\FirstUnit\Model\TableDataFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
	protected $_postFactory;

	protected $fileUploader;
    protected $_model;
 
    public function __construct(
        Context $context,
        ManagerInterface $messageManager,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        TableDataFactory $model
    )
    {
        $this->_messageManager       = $messageManager;
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->_model = $model;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    
        parent::__construct($context);
    }

	public function execute()
	{
		
        $id = $this->getRequest()->getParam('id');
        echo $id;
        try {
            $model = $this->_model->create();
            $model->load($id);
            $model->delete();
        } catch (\Exception $e) {
            $this->_messageManager->addError($e->getMessage());
        }
        $this->_redirect('*/*/demo');
		return ;
		

	}
}