<?php

namespace Learning\FirstUnit\Controller\Adminhtml\User;

class GridSave extends \Magento\Backend\App\Action
{
    protected $adapterFactory;
   
    protected $uploader;
  
    protected $filesystem;

    protected $timezoneInterface;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Learning\FirstUnit\Model\TableDataFactory $TableDataFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,\Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem

    
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        $this->TableDataFactory = $TableDataFactory;
        parent::__construct($context);
        
    }

    public function execute()
    {

        $data = $this->getRequest()->getPostValue();

        if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
           
            try {
            $yourFolderName = 'images/';

            $yourInputFileName = 'image';  
            $base_media_path = $this->getRequest()->getFiles($yourFolderName);   
           
            $uploader = $this->uploader->create(
            ['fileId' => 'image']
            );
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
            $uploader->setAllowRenameFiles(true);
           // $uploader->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
            $result = $uploader->save(
            $mediaDirectory->getAbsolutePath().'images'
            );
            $data['image'] = $result['file'];
            }
            catch (\Exception $e) {
                if ($e->getCode() == 0) {
                $this->messageManager->addError($e->getMessage());
                }
            }
            } 
            else {
            if (isset($data['image']) && isset($data['image']['value'])) {
                if (isset($data['image']['delete'])) {
                    $data['image'] = null;
                    $data['delete_image'] = true;
                } 
                elseif (isset($data['image']['value'])) {
                  $data['image'] = $data['image']['value'];
                } 
                else {
                $data['image'] = null;
                }
            }
            }

        if (!$data) {
            $this->_redirect('usercontrol/user/index');
            $this->messageManager->addError(_('No Data Entered'));
            return;
        }
        try {
            $rowData = $this->TableDataFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('usercontrol/user/index');
    }

   
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Webkul_Grid::save');
    }
}
