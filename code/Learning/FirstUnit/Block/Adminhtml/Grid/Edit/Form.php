<?php

namespace Learning\FirstUnit\Block\Adminhtml\Grid\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Learning\FirstUnit\Model\Status $options,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);

    }

  
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('data_row');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('addGrid_');
        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add User'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
            'title' => __('Image'),
            'label' => __('Image'),
            'name' => 'image',
            'note' => 'Allow image type: jpg, jpeg, gif, png',
            'frame_callback' => array($this, 'show_image'),
            'required' => true,
            ]
            );

        // $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        // $fieldset->addField(
        //     'content',
        //     'editor',
        //     [
        //         'name' => 'content',
        //         'label' => __('Content'),
        //         'style' => 'height:36em;',
        //         'required' => true,
        //         'config' => $wysiwygConfig
        //     ]
        // );

        // $fieldset->addField(
        //     'publish_date',
        //     'date',
        //     [
        //         'name' => 'publish_date',
        //         'label' => __('Publish Date'),
        //         'date_format' => $dateFormat,
        //         'time_format' => 'H:mm:ss',
        //         'class' => 'validate-date validate-date-range date-range-custom_theme-from',
        //         'class' => 'required-entry',
        //         'style' => 'width:200px',
        //     ]
        // );
        // $fieldset->addField(
        //     'is_active',
        //     'select',
        //     [
        //         'name' => 'is_active',
        //         'label' => __('Status'),
        //         'id' => 'is_active',
        //         'title' => __('Status'),
        //         'values' => $this->_options->getOptionArray(),
        //         'class' => 'status',
        //         'required' => true,
        //     ]
        // );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $p = $form->getElement('image')->getValue();
        $form->getElement('image')->setValue('images/' . $p);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function show_image($value)
    {
    if (empty($value)){
        return '';
    }
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $mediaUrl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    $width = 150;
    return "<img src='" . $mediaUrl . $value . "' width='" . $width . "'/>";
    }   

}
