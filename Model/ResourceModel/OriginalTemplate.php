<?php

namespace Klymko\ProductImageSlider\Model\ResourceModel;

class OriginalTemplate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('kl_product_image_slider_original_template', 'id');
    }
}
