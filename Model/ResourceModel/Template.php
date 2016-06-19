<?php

namespace Klymko\ProductImageSlider\Model\ResourceModel;

class Template extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('kl_product_image_slider_template', 'id');
    }
}