<?php
namespace Learning\FirstUnit\Model\Session;

class Storage extends \Magento\Framework\Session\Storage
{
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $namespace = 'Mysession',
        array $data = []
    ) {
        parent::__construct($namespace, $data);
    }
}