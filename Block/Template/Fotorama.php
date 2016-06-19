<?php

namespace Klymko\ProductImageSlider\Block\Template;

class Fotorama extends \Klymko\ProductImageSlider\Block\Product\Image
{
	/**
	 * Configuration data of template
	 * @var Array
	 */
	protected $_configData;

	/**
	 * Template file for product list
	 * @var string
	 */
	protected $_productListTemplate = 'Klymko_ProductImageSlider::product/list/template/fotorama.phtml';

	/**
	 * Get template configuration
	 * @param  string $group 
	 * @param  string $var   
	 * @return mixed 
	 */
	public function getTemplateConfig($group, $var)
	{
		if ($this->_configData === null) {
			$this->_configData = $this->_jsonDecoder->decode($this->getSelectedTemplate()->getConfigData(), true);
		}

		if (isset($this->_configData[$group][$var])) {
			return $this->_configData[$group][$var];
		}

		return null;
	}

}