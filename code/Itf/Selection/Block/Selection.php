<?php
   
namespace Itf\Selection\Block;

use Magento\Framework\View\Element\Template;
use Itf\Selection\Model\SelectionFactory;
use Itf\Selection\Model\UserselectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Session\SessionManagerInterface;
use Itf\Selection\Helper\Data;

class Selection extends Template
{
	protected $_modelFactory;
	protected $_userselectionFactory;
	protected $_storeManager;
    protected $_urlInterface;
	protected $_customerSession;
    protected $_session;
    protected $_helper;
	
    public function __construct(
		Template\Context $context,
		SelectionFactory $modelFactory,
		UserselectionFactory $userselectionFactory,
		StoreManagerInterface $storeManager,
        UrlInterface $urlInterface,    
        Session $customersession,    
        SessionManagerInterface $session,    
        Data $helper,    
		array $data = []
	)
	{
		$this->_modelFactory 			= $modelFactory;
		$this->_userselectionFactory 	= $userselectionFactory;
		$this->_storeManager 			= $storeManager;
		$this->_urlInterface 			= $urlInterface;
		$this->_customerSession  	 	= $customersession;
		$this->_session  	 			= $session;
		$this->_helper	  	 			= $helper;
		parent::__construct($context, $data);
	}

	public function getSelectionData($id='')
	{
		$collection	= $this->_modelFactory->create()->getCollection()->addFieldToFilter('main_table.status', array('eq'=> '1'));
		
		if($id!='') $collection->addFieldToFilter('main_table.entity_id', array('eq'=> $id));
		
		$collection->getSelect()->joinLeft(
			['qd' => 'is_question'],
			'main_table.entity_id = qd.selection_id and qd.status = "1"',
			['questiondata' => new \Zend_Db_Expr('GROUP_CONCAT(CONCAT_WS("@@@", qd.entity_id, qd.question, qd.options, qd.choices) SEPARATOR "@_@")')]
		)
		->group('main_table.entity_id');
		//hi its working 
		return ($id=='') ? $collection : $collection->getFirstItem();
	}
	
	public function getUserSelectionData()
	{
		$result = '';
		print_r($this->_customerSession->isLoggedIn());
		if($this->_customerSession->isLoggedIn()){
			$customerid	 	= 	$this->_customerSession->getCustomer()->getId();	
			//echo $customerid;
			$collection		= 	$this
								->_userselectionFactory
								->create()
								->getCollection()
								->addFieldToFilter('main_table.status', array('eq'=> '1'))
								->addFieldToFilter('main_table.user_id', array('eq'=> $customerid))
								->getFirstItem();
				//print_r($collection);				
			if($collection){
				$result = $collection->getSelection();
			}
		}
		
		return $result;
	}
	
	public function getMediaUrl()
	{
		return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}
	
	public function getBaseUrl()
	{
		return $this->_urlInterface->getBaseUrl();
	}
	
	public function getAutoLaunchStatus()
	{
		return $this->_helper->getConfigValue('autolaunch/general/status');
	}
	
	public function setSessionSelectionId($id)
	{
		$this->_session->start();
		$selectionid = $this->_session->getSelectionIdData();
		
		if(is_array($selectionid)){
			if(!in_array($id, $selectionid)){
				$data = $selectionid;
				array_push($data, $id); 
			}
		}else{
			$data = array($id);  
		}
		
		if(isset($data)) $this->_session->setSelectionIdData($data);
		
		return true;
	}
	
	public function getSessionSelectionId()
	{
		$this->_session->start();
		return $this->_session->getSelectionIdData();  
	}
	
	public function unsSessionSelectionId()
	{
		$this->_session->start();
		return $this->_session->unsSelectionIdData();
	}
	
	public function setSessionSelection($data)
	{
		$this->_session->start();
		$this->_session->setSelectionData($data);  
	}
	
	public function getSessionSelection()
	{
		$this->_session->start();
		return $this->_session->getSelectionData();  
	}
	
	public function unsetSessionSelection()
	{
		$this->_session->start();
		return $this->_session->unsSelectionData();  
	}
}