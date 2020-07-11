<?php

namespace Itf\Selection\Block\Adminhtml\Selection\Edit;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Itf\Selection\Model\Status;

class Form extends Generic
{
    protected $_systemStore;
 
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
		Status $options,
        array $data = []
    ) 
    {
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model 		= $this->_coreRegistry->registry('row_data');
        $form 		= $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );
 
        $form->setHtmlIdPrefix('is_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Product Selection'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Product Selection'), 'class' => 'fieldset-wide']
            );
        }
 
        $fieldset->addField(
            'title',
            'text',
            [
                'name' 		=> 'title',
                'label' 	=> __('Title'),
                'id' 		=> 'title',
                'title' 	=> __('Title'),
                'class' 	=> 'required-entry',
                'required' 	=> true,
            ]
        );
		
		$fieldset->addField(
            'image',
            'image',
            array(
                'name' 		=> 'image',
                'label' 	=> __('Image'),
                'id' 		=> 'image',
                'title' 	=> __('Image'),
                'class' 	=> 'required-entry',
                'required' 	=> true,
                'note' 		=> 'Allowed image type : jpg, jpeg, gif, png'
            )
        );
		
        $fieldset->addField(
            'status',
            'select',
            [
                'name' 		=> 'status',
                'label' 	=> __('Status'),
                'id' 		=> 'status',
                'title' 	=> __('Status'),
                'values' 	=> $this->_options->getOptionArray(),
                'class' 	=> 'status',
                'required' 	=> true,
            ]
        );
				
        $form->setValues($model->getData());
		$form->getElement('image')->setValue('selection/title/'.$form->getElement('image')->getValue());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}