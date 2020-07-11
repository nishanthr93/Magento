<?php

namespace Itf\Selection\Ui\Component\Listing\Selection\Column;
 
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\UrlInterface;
 
class Action extends Column
{
    const ROW_EDIT_URL 		= 'selection/selection/add';
    const ROW_DELETE_URL 	= 'selection/selection/delete';
	
    protected $_urlBuilder;
    private $_editUrl;
    private $_deleteUrl;
 
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL,
        $deleteUrl = self::ROW_DELETE_URL
    ) 
    {
        $this->_urlBuilder 	= $urlBuilder;
        $this->_editUrl 	= $editUrl;
        $this->_deleteUrl 	= $deleteUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
 
    public function prepareDataSource(array $dataSource)
	{
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as & $item) {
				if (isset($item['entity_id'])) {
					$item[$this->getData('name')] = [
						'edit' => [
							'href' => $this->_urlBuilder->getUrl(
								$this->_editUrl, 
								[
									'id' => $item['entity_id']
								]
							),
							'label' => __('Edit')
						],
						'delete' => [
							'href' => $this->_urlBuilder->getUrl(
								$this->_deleteUrl,
								[
									'id' => $item['entity_id']
								]
							),
							'label' => __('Delete'),
							'confirm' => [
								'title' => __('Delete "${ $.$data.title }"'),
								'message' => __('Are you sure you want to delete the data "${ $.$data.title }" ?')
							]
						]
					];
				}
			}
		}
		return $dataSource;
	}
}

