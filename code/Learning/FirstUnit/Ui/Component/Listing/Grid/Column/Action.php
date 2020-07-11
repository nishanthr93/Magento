<?php

namespace Learning\FirstUnit\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{
 
    const ROW_EDIT_URL = 'usercontrol/user/addgriduser';
    const ROW_DELETE_URL = 'usercontrol/user/deleteuser';
    const ROW_MAIL_URL = 'usercontrol/user/testmail';
 
    protected $_urlBuilder;

  
    private $_editUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL,
        $deleteUrl = self::ROW_DELETE_URL,
        $mailURL = self::ROW_MAIL_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        $this->_deleteUrl = $deleteUrl;
        $this->_mailUrl = $mailURL;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['id']]
                        ),
                        'label' => __('Edit'),
                        'onclick' =>"return popitup('".$this->getUrl('*/*/edit', array('id' => $this->getId()))."')",
                    ];
                }
            }
        }
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_deleteUrl,
                            ['id' => $item['id']]
                        ),
                        'label' => __('Delete'),
                    ];
                }
            }
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['mail'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_mailUrl,
                            ['id' => $item['id']]
                        ),
                        'label' => __('Mail'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}

