<?php

namespace Itf\Selection\Controller\Selection;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\CustomerFactory;
use Itf\Selection\Block\Selection as Selectionblock;

class Popupsave extends Action
{
	protected $jsonFactory;
	protected $customerSession;
	protected $selection;
	
	public function __construct(
		Context $context,
		JsonFactory $jsonFactory,
		Session $customerSession,
		CustomerFactory $customerFactory,
		Selectionblock $Selectionblock
	) 
	{
		parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
		$this->customerSession = $customerSession;
		$this->_customerFactory  = $customerFactory;
		$this->selection = $Selectionblock;
	}

    public function execute()
    {
		$resultJson = $this->jsonFactory->create();
        $status 	= '1';
        $result 	= [];
		
		$data 			= $this->getRequest()->getPostValue();
		$selectionid	= $data['id'];
		
		$formdata 		= array();
		parse_str($data['form'], $formdata);
		$resultdata		= $formdata;
		$formdata		= json_encode($formdata);
		
		$customerid = '';
		$firstname 	= '';
		$lastname 	= '';
		$email 		= '';
		
        if($this->customerSession->isLoggedIn()){
			$customerid	 			= 	$this->customerSession->getCustomer()->getId();		
			$userselectionRecord 	= 	[
											'user_id' 		=> $customerid,
											'selection_id' 	=> $selectionid,
											'selection' 	=> $formdata,
											'status' 		=> '1'
										];
									
			$userselectioncheck 	= 	$this->_objectManager->create('Itf\Selection\Model\Userselection')
										->getCollection()
										->addFieldToFilter('user_id', array('eq' => $customerid))
										->addFieldToFilter('selection_id', array('eq' => $selectionid));
			$userselectioncheckdata =	$userselectioncheck->getFirstItem();
			if($userselectioncheckdata->getData()){
				$userselectionRecord['entity_id'] = $userselectioncheckdata->getEntityId();
			}
			
			$userselectionModel 	= 	$this->_objectManager->create('Itf\Selection\Model\Userselection');
			$userselectionModel->setData($userselectionRecord);
			$userselectionModel->save();
			
			$customerinformation = $this->_customerFactory->create()->load($customerid);
			$firstname 	= $customerinformation->getFirstname();
			$lastname 	= $customerinformation->getFirstname();
			$email 		= $customerinformation->getEmail();
			
			//echo '<pre>'; print_r($customerinformation->getData());
		}
		
		$xmlarray 			= ['question_set_id' => $selectionid];
		$xmlquestionitem 	= [];
		
		foreach($resultdata['selection'] as $xmlkey => $xmldata){
			if($xmldata!=''){
				$xmlvalue 	= (is_array($xmldata)) ? implode(',', $xmldata) : $xmldata;
				
				$xmlquestionitem[] 	= 	[
											'question_id' 	=> $xmlkey,
											'answers' 		=> $xmlvalue
										];
			}
		}
		
		$xmlarray['question_item'] 	= 	$xmlquestionitem;
		$xmlarray['customer'] 		= 	[
											'customer_id' 	=> $customerid,
											'firstname' 	=> $firstname,
											'lastname' 		=> $lastname,
										];		
										
		//print_r($xmlarray);die;								
		$xml = $this->arrayToXml($xmlarray); 
		echo $xml;
		
		$result 			= [];
		$resultdata['id'] 	= $selectionid;
		$sessionselection = $this->selection->getSessionSelection();
		if($sessionselection){
			$sessionarray	= json_decode($sessionselection, true);
			$idcolumn		= array_column($sessionarray, 'id');
			$search			= array_search($selectionid, $idcolumn);
			
			if($search!== false){
				$sessionarray[$search]	= $resultdata;
			}else{
				$sessionarray[]			= $resultdata;
			}
			
			$result				= json_encode($sessionarray);
		}else{
			$result 			= json_encode([$resultdata]);
		}
	
		$this->selection->setSessionSelection($result);
		
        return $resultJson->setData([
            'status' 	=> $status,
            'result' 	=> $result
        ]);
    }
	
	public function arrayToXml($array, $rootElement = null, $xml = null){ 
		$_xml = $xml; 
		
		if($_xml === null){ 
			$_xml = new \SimpleXMLElement($rootElement !== null ? $rootElement : "<?xml version=\"1.0\"?><product_selection></product_selection>"); 
		} 
		   
		foreach($array as $k => $v){ 
			if(is_array($v)){
				if(!is_numeric($k)){

					$this->arrayToXml($v, $k, $_xml->addChild($k));
				}
				else{
					$this->arrayToXml($v, $k, $_xml->addChild('item'));
				}
			}
			else{ 
				$_xml->addChild($k, $v); 
			} 
		} 
		
		return $_xml->asXML(); 
	}

	public function curlSearch($xml){

		$url = "https://www.google.com/search?q="; 


		$headers = array(
		    "Content-type: text/xml",
		    "Content-length: " . strlen($xml),
		    "Connection: close",
		);
		 
		$ch = curl_init();  
		 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		curl_setopt($ch, CURLOPT_URL, $url); 

		//curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		//                  "xmlRequest=" . $input_xml)
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		  
		$result = curl_exec($ch); 
		  
		return $result; 
	}
}