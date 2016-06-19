<?php

namespace Klymko\ProductImageSlider\Model;

class OriginalTemplate extends \Magento\Framework\Model\AbstractModel
{

	/**
     * @return void
     */
    protected function _construct()
    {
    	$this->_init('Klymko\ProductImageSlider\Model\ResourceModel\OriginalTemplate');
    }

    /**
     * Convert collection to option array
     * @return Array
     */
    public function toOptionArray($keyAsUrl = false)
    {
    	$collection = $this->getCollection();
    	$array = ['' =>	''];
    	foreach ($collection as $item) {
    		$array[$item->getId()] = __($item->getTitle());
    	}

    	return $array;
    }
}
