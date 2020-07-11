<?php
namespace Learning\FirstUnit\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Learning\FirstUnit\Model\TableDataFactory;
use Magento\Catalog\Block\Product\ImageBuilder;
use Learning\FirstUnit\Model\Session\Storage;


class Index extends Template
{
    protected $_model;
    protected $_formkey;
    public $_storeManager;
    protected $session;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey, 
        TableDataFactory $model,
        Storage $session,  
        array $data = []
    )
    {      
        $this->_formkey = $formKey;  
        $this->_model = $model;
        $this->session = $session;
        parent::__construct($context, $data);
        
    }

	public function sayHello()
	{
		return __('Hello Hi');
    }
    public function getEmp()
    {
        $Create_Value = $this->_model->create();
        $Datas = $Create_Value->getCollection();
        return $Datas;
    }

    public function getFormKey()
    {
         return $this->_formkey->getFormKey();
    }

    public function getFormAction()
    {
        return '/magento2/test/front/save';
    }

    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
    public function updateUser()
    {
        $postData = $this->getRequest()->getParams();
        $id = $postData['id'];
        
        $get_value = $this->_model->create();
        $get_collect = $get_value->getCollection()->addFieldToFilter('id',$id)->getFirstItem();
       
        return $get_collect;
    }

    public function sessionData()
    {
        // $this->session->setData('custom', 'value');
        // $this->session->getData('custom');
        // $this->session->unsetData('custom');

        $array = array("first"=>1,"two"=>2);
        $this->session->setMySession($array);

       // To get session data : 
        $this->session->getMySession();

      //  To get all session data : 
        $this->session->getData();
    }
}