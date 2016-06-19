<?php

namespace Klymko\ProductImageSlider\Block\Product\View;

class Gallery extends \Magento\Catalog\Block\Product\View\Gallery
{

	/**
	 * Template block
	 * @var \Klymko\ProductImageSlider\Block\Template
	 */
	protected $_templateBlock;

	/**
	 * @param \Klymko\ProductImageSlider\Block\Template $templateBlock 
	 * @param \Magento\Catalog\Block\Product\Context    $context       
	 * @param \Magento\Framework\Stdlib\ArrayUtils      $arrayUtils    
	 * @param \Magento\Framework\Json\EncoderInterface  $jsonEncoder   
	 * @param Array                                     $data          
	 */
	public function __construct(
		\Klymko\ProductImageSlider\Block\Template $templateBlock,
		\Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        array $data = []
	) {
		parent::__construct($context, $arrayUtils, $jsonEncoder, $data);
		$this->_templateBlock = $templateBlock;
	}

	/**
	 * Return default module name. If module disabled or disabled on product view
	 * templates and vars must take from catalog's module
	 * @return stirng
	 */
	public function getModuleName()
	{
		return 'Magento_Catalog';
	}

	/**
	 * Set template if module enabled
	 * @param string $template path to template file
	 */
	public function setTemplate($template)
	{
		$helper = $this->_templateBlock->getDataHelper();
		if ($helper->moduleEnabled() || $helper->canShowOnProductPage()) {
			$template = 'Klymko_ProductImageSlider::product/view/template/' . $this->_getOriginalTemplate()->getCode() . '.phtml';
		}

		return parent::setTemplate($template);
	}

	/**
	 * Retrieve original template
	 * @return \Klymko\ProductImageSlider\Model\OriginalTemplate
	 */
	protected function _getOriginalTemplate()
	{
		return $this->_templateBlock->getOriginalTemplate();
	}

	/**
	 * Retrieve template block
	 * @return \Klymko\ProductImageSlider\Block\Template
	 */
	public function getTemplateBlock()
	{
		return $this->_templateBlock;
	}

}
