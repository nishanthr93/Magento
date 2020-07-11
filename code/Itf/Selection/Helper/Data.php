<?php

namespace Itf\Selection\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

// Config
use Magento\Framework\App\Config\ScopeConfigInterface;

// Image
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Data extends AbstractHelper
{
	protected $_scopeConfig; 

	protected $_fileUploaderFactory;
	protected $_fileSystem;
	protected $_directoryList;
	protected $_file;

    public function __construct( 
		Context $context, 
        ScopeConfigInterface $scopeConfig,
		UploaderFactory $fileUploaderFactory, 
		Filesystem $fileSystem,
		DirectoryList $directoryList,
		File $file
	) 
	{
		$this->_scopeConfig = $scopeConfig;
		
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->_fileSystem = $fileSystem;
		$this->_directoryList = $directoryList;
		$this->_file = $file;
		
		parent::__construct($context); 
    }

	public function getConfigValue($data)
	{
		return $this->_scopeConfig->getValue($data);
	}
	
	public function fileUpload($file, $path, $ext=[])
	{
		if (isset($_FILES[$file]) && isset($_FILES[$file]['name']) && $_FILES[$file]['name']!=''){
			$path = $this->_directoryList->getPath('media').'/'.$path;
			if(!is_dir($path)){
				$this->_file->mkdir($path, 0775);
			}
			
			$ext = (count($ext)==0) ? ['jpg', 'jpeg', 'gif', 'png'] : $ext;
			$uploader = $this->_fileUploaderFactory->create(['fileId' => $file]);
			$uploader->setAllowedExtensions($ext);
			$uploader->setFilesDispersion(false);
			$uploader->setAllowCreateFolders(true);
			$uploader->setAllowRenameFiles(false);
			  
			$save 	= $this->_fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath($path.'/');
			$result = $uploader->save($save);
			
			return $result['file'];
		}else{
			return false;
		}
	}
}