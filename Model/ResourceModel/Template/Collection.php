<?php

namespace Klymko\ProductImageSlider\Model\ResourceModel\Template;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Klymko\ProductImageSlider\Model\Template', 'Klymko\ProductImageSlider\Model\ResourceModel\Template');
    }
}
