<?php

namespace Learning\FirstUnit\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Delete extends Column
{
 
    // const ROW_EDIT_URL = 'usercontrol/user/addgriduser';
    const ROW_DELETE_URL = 'usercontrol/user/deleteuser';
 
    protected $_urlBuilder;

  
    private $_editUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $deleteUrl = self::ROW_DELETE_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_deleteUrl = $deleteUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
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
        }
        

        return $dataSource;
    }
}

