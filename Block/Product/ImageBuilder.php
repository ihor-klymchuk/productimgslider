<?php

namespace Klymko\ProductImageSlider\Block\Product;

class ImageBuilder extends \Magento\Catalog\Block\Product\ImageBuilder
{

	/**
	 * Template block
	 * @var \Klymko\ProductImageSlider\Block\Template
	 */
	protected $_templateBlock;

	/**
	 * Our template factory
	 * @var \Klymko\ProductImageSlider\Block\Product\ImageFactory
	 */
	protected $_templateImageSlider;

	/**
	 * Request
	 * @var \Magento\Framework\App\RequestInterfac
	 */
	protected $_request;

	/**
	 * Scope config
	 * @var \Magento\Framework\App\Config\ScopeConfigInterface
	 */
	protected $_scopeConfig;

	/**
	 * Template factory
	 * @var Klymko\ProductImageSlider\Model\Template
	 */
	protected $_templateFactory;

	/**
	 * Data helper
	 * @var \Klymko\ProductImageSlider\Helper\Data
	 */
	protected $_dataHelper;

	/**
	 * Loaded template
	 * @var Klymko\ProductImageSlider\Model\Template
	 */
	protected $_selectedTemplate;

	/**
	 * Page config
	 * @var \Magento\Framework\View\Page\Config
	 */
	protected $_pageConfig;

	/**
	 * @param \Klymko\ProductImageSlider\Block\Template        $templateBlock 
	 * @param \Magento\Framework\View\Element\Template\Context $context       
	 * @param Array                                            $data          
	 */
	public function __construct(
		\Magento\Framework\App\RequestInterface $request,
		\Klymko\ProductImageSlider\Model\TemplateFactory $templateFactory,
		\Klymko\ProductImageSlider\Helper\Data $dataHelper,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Helper\ImageFactory $helperFactory,        
		\Magento\Framework\View\Page\Config $pageConfig,
        \Magento\Catalog\Block\Product\ImageFactory $imageFactory
	){
		$this->_request = $request;
		$this->_dataHelper = $dataHelper;
		$this->_pageConfig = $pageConfig;
		$this->_templateFactory = $templateFactory;
		$this->_scopeConfig = $scopeConfig;
		parent::__construct($helperFactory, $imageFactory);

		$this->_renderRequiredCss();
	}

	/**
	 * Render required css and add it to page
	 * @return $this
	 */
	protected function _renderRequiredCss()
	{
		$requiredCss = $this->_getSelectedTemplate()
			->getTemplateModel()
			->getRequiredCss();
		foreach ($requiredCss as $css) {
			$this->_pageConfig->addPageAsset($css);
		}

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function create()
	{
		$selectedTemplate = $this->_getSelectedTemplate();

		if (!$this->_dataHelper->moduleEnabled()
			|| !$this->_dataHelper->canShowOnProductList() 
			|| !$this->_canUseTemplate()
			|| !$selectedTemplate
			|| !$selectedTemplate->getId()
		) {
			return parent::create();
		}

		
        $helper = $this->helperFactory->create()
       		->init($this->product, $this->imageId);

        $imagesize = $helper->getResizedImageInfo();

        $data = [
            'data' => [
            	'product'	=> $this->product,
            	'selected_template'	=>	$selectedTemplate,
                'image_url' => $helper->getUrl(),
                'width' => $helper->getWidth(),
                'height' => $helper->getHeight(),
                'label' => $helper->getLabel(),
                'ratio' =>  $this->getRatio($helper),
                'custom_attributes' => $this->getCustomAttributes(),
                'resized_image_width' => !empty($imagesize[0]) ? $imagesize[0] : $helper->getWidth(),
                'resized_image_height' => !empty($imagesize[1]) ? $imagesize[1] : $helper->getHeight(),
            ],
        ];

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $templateBlock = $objectManager->create('Klymko\ProductImageSlider\Block\Template\\' . ucfirst($selectedTemplate->getCode()), $data);
        return $templateBlock;
	}


	/**
	 * Get selected template
	 * @return \Klymko\ProductImageSlider\Model\Template
	 */
	protected function _getSelectedTemplate()
	{
		if ($this->_selectedTemplate === null) {
			$this->_loadSelectedTemplate();
		}

		return $this->_selectedTemplate;
	}

	/**
	 * Load selected template
	 * @return Klymko\ProductImageSlider\Model\Template
	 */
	protected function _loadSelectedTemplate()
	{
		$this->_selectedTemplate = $this->_templateFactory->create()
				->addOriginToSelect()
				->load($this->_dataHelper->getProductListConfigTemplateId());

		return $this;
	}

	/**
	 * Can be use it on current page
	 * @return boolean
	 */
	protected function _canUseTemplate()
	{
		$location = $this->_scopeConfig->getValue(\Klymko\ProductImageSlider\Model\Config\ProductList::PRODUCT_LIST_LOCATION);
		$location = explode(',', $location);
		if (!in_array($this->_request->getFullActionName(), $location)) {
			return false;
		}

		return true;
	}
}
