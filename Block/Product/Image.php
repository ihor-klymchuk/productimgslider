<?php

namespace Klymko\ProductImageSlider\Block\Product;

class Image extends \Magento\Catalog\Block\Product\Image
{

	/**
	 * Gallery block
	 * @var \Klymko\ProductImageSlider\Block\Product\View\Gallery
	 */
	protected $_galleryBlock;

	/**
	 * Template Block
	 * @var \Klymko\ProductImageSlider\Block\Template
	 */
	protected $_templateBlock;

	/**
	 * Template file for product list
	 * @var string
	 */
	protected $_productListTemplate = '';

	/**
	 * Data helper
	 * @var Klymko\ProductImageSlider\Helper\Data
	 */
	protected $_dataHelper;

	/**
	 * Json decoder
	 * @var \Magento\Framework\Json\DecoderInterface
	 */
	protected $_jsonDecoder;

	/**
	 * @param \Klymko\ProductImageSlider\Block\Product\View\Gallery $galleryBlock  
	 * @param \Magento\Catalog\Model\ProductFactory                 $productFacory 
	 * @param \Klymko\ProductImageSlider\Helper\Data                $dataHelper    
	 * @param \Magento\Framework\View\Element\Template\Context      $context       
	 * @param \Magento\Framework\Json\DecoderInterface              $jsonDecoder   
	 * @param array                                                 $data          
	 */
	public function __construct(		
		\Klymko\ProductImageSlider\Block\Product\View\Gallery $galleryBlock,
		\Magento\Catalog\Model\ProductFactory $productFacory,		
		\Klymko\ProductImageSlider\Helper\Data $dataHelper,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\DecoderInterface $jsonDecoder,
        array $data = []
	) {
		$this->_galleryBlock = $galleryBlock;
		$this->_dataHelper = $dataHelper;
		$this->_jsonDecoder = $jsonDecoder;

		if (isset($data['product'])) {
			$this->_addGalleryToProduct($data['product']);
		}

		$this->_galleryBlock->setProduct($this->product);
		parent::__construct($context, $data);
	}

	/**
	 * Add gallery to product
	 * @param Magento\Catalog\Model\Product $product
	 */
	protected function _addGalleryToProduct($product)
	{
		$product->getResource()->getAttribute('media_gallery')
    			->getBackend()->afterLoad($product);
		$this->product = $product;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTemplate()
	{
		if ($this->_dataHelper->moduleEnabled() && $this->_dataHelper->canShowOnProductList()) {			
			$template  = $this->_productListTemplate;
			return $template;
		}

		return parent::getTemplate();
	}

	/**
	 * Retrieve gallery block
	 * @return \Klymko\ProductImageSlider\Block\Product\View\Gallery
	 */
	public function getGalleryBlock()
	{
		return $this->_galleryBlock->setProduct($this->product);
	}
}
