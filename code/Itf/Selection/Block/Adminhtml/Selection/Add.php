<?php
   
namespace Itf\Selection\Block\Adminhtml\Selection;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Add extends Container
{
    protected $_coreRegistry = null;
 
    public function __construct(
        Context $context,
		Registry $registry,
        array $data = []
    ) 
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    protected function _construct()
    {
        $this->_objectId 	= 'row_id';
        $this->_blockGroup 	= 'Itf_Selection';
        $this->_controller 	= 'adminhtml_selection';
        parent::_construct();
        if ($this->_isAllowedAction('Itf_Selection::add')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }
 
    public function getHeaderText()
    {
        return __('Add Product Selection');
    }
 
	public function getFormHtml()
    {
        $rd = $this->_coreRegistry->registry('row_data');
        
		$qd = ($rd && isset($rd['questiondata']) && $rd['questiondata']!='') ? $rd['questiondata'] : '';
		
        $html = parent::getFormHtml();
        $html .= $this->getLayout()->createBlock("Magento\Framework\View\Element\Template")->setKey($qd)->setTemplate('Itf_Selection::customdata/question.phtml')->toHtml(); 
        return $html;
    }
	
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
 
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
 
        return $this->getUrl('*/*/save');
    }
}