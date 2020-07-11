<?php
namespace Learning\FirstUnit\Controller\Front;
 
use Learning\FirstUnit\Model\TableDataFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
 
class Save extends \Magento\Framework\App\Action\Action
{
   
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
        $this->messageManager       = $messageManager;
 
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->_model = $model;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    
        parent::__construct($context);
    }
 
    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();
        $uploadedFile = $this->uploadFile();
        if($uploadedFile){$postData['image']=$uploadedFile;}
        $tablemodel = $this->_model -> create();
        $tablemodel->setData($postData);
        
        $tablemodel->save();
        $this->_redirect('*/*/adduser');
        return;
    }
 
    public function uploadFile()
    {

        $yourFolderName = 'images/';

        $yourInputFileName = 'image';
 
        try{
            $file = $this->getRequest()->getFiles($yourInputFileName);
            $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;
 
            if ($file && $fileName) {
                $target = $this->mediaDirectory->getAbsolutePath($yourFolderName); 
                $uploader = $this->fileUploader->create(['fileId' => $yourInputFileName]);
                $uploader->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png', 'zip']);
                $uploader->setAllowCreateFolders(true);
                $uploader->setAllowRenameFiles(true);
                $result = $uploader->save($target);
                if ($result['file']) {
                    $this->messageManager->addSuccess(__('File has been successfully uploaded.')); 
                }
                
                return $uploader->getUploadedFileName();
            }
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
 
        return false;
    }
}