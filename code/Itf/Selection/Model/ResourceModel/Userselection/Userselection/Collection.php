<?php

namespace Itf\Selection\Model\ResourceModel\Userselection\Userselection;

use Itf\Selection\Model\ResourceModel\Userselection\Collection as UserselectionCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends UserselectionCollection implements SearchResultInterface
{
    protected $_aggregations;
   
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        $mainTable,
        $eventPrefix,
        $eventObject,
        $resourceModel,
        $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
        $connection = null,
        AbstractDb $resource = null
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }
    
    public function getAggregations()
    {
        return $this->_aggregations;
    }
   
    public function setAggregations($aggregations)
    {
        $this->_aggregations = $aggregations;
    }
    
    public function getSearchCriteria()
    {
        return null;
    }
    
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }
    
    public function getTotalCount()
    {
        return $this->getSize();
    }
	
    public function setTotalCount($totalCount)
    {
        return $this;
    }
	
    public function setItems(array $items = null)
    {
        return $this;
    }
}