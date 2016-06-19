<?php

namespace Klymko\ProductImageSlider\Block\Adminhtml;

/**
 * Admin blog category
 */
class Template extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'Klymko_ProductImageSlider';
        $this->_headerText = __('Templates');
        $this->_addButtonLabel = __('Add New Template');
        parent::_construct();
    }
}
