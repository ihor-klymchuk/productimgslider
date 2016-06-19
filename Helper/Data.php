<?php

namespace Klymko\ProductImageSlider\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

	const SLIDER_MODULE_ENABLED = 'productimgslider/general/enable';

	/**
	 * Is module enabled
	 * @return boolean 
	 */
	public function moduleEnabled()
	{
		return $this->scopeConfig->getValue(
            self::SLIDER_MODULE_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );	
	}

	/**
	 * Can show slider on product page
	 * It's can be disabled in system/config or template not selected
	 * @return boolean
	 */
	public function canShowOnProductPage()
	{
		return $this->scopeConfig->getValue(
	            \Klymko\ProductImageSlider\Model\Config\ProductView::PRODUCT_VIEW_ENABLE,
	            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	        ) && $this->getProductViewConfigTemplateId();
	}

	/**
	 * Can show slider on product list (category) page
	 * @return booleans
	 */
	public function canShowOnProductList()
	{
		return $this->scopeConfig->getValue(
	            \Klymko\ProductImageSlider\Model\Config\ProductList::PRODUCT_LIST_ENABLE,
	            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	        ) && $this->getProductListConfigTemplateId();
	}

	/**
	 * Get template id for product list
	 * @return int
	 */
	public function getProductListConfigTemplateId()
	{
		return $this->scopeConfig->getValue(
	            \Klymko\ProductImageSlider\Model\Config\ProductList::PRODUCT_LIST_TEMPLATE,
	            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	        );
	}

	/**
	 * Get selected template from configuration for product view page
	 * @return int 
	 */
	public function getProductViewConfigTemplateId()
	{
		return $this->scopeConfig->getValue(
	            \Klymko\ProductImageSlider\Model\Config\ProductView::PRODUCT_VIEW_TEMPLATE,
	            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	        );
	}

}