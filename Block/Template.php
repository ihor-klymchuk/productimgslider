<?php

namespace Klymko\ProductImageSlider\Block;

class Template extends \Magento\Framework\View\Element\Template
{
	/**
	 * Template Factory
	 * @var \Klymko\ProductImageSlider\Model\TemplateFactory
	 */
	protected $_templateFactory;

	/**
	 * Data helper
	 * @var \Klymko\ProductImageSlider\Helper\Data
	 */
	protected $_dataHelper;

	/**
	 * Configuration data of template
	 * @var Array
	 */
	protected $_configData;

	/**
	 * Json Decoder
	 * @var Magento\Framework\Json\DecoderInterface
	 */
	protected $jsonDecoder;

	/**
	 * Original template factory
	 * @var \Klymko\ProductImageSlider\Model\OriginalTemplateFactory
	 */
	protected $_originalTemplateFactory;

	/**
	 * Original tempate
	 * @var \Klymko\ProductImageSlider\Model\OriginalTemplate
	 */
	protected $_originalTempalate;

	/**
	 * Current template
	 * @var Klymko\ProductImageSlider\Model\Template
	 */
	protected $_template;

	/**
	 * Asset repository
	 * @var \Magento\Framework\View\Asset\Repository
	 */
	protected $_assetRepository;

	/**
	 * Asset collection
	 * @var \Magento\Framework\View\Asset\GroupedCollection
	 */
	protected $_assetCollection;

	/**
	 * Product list temlate file
	 * @var string
	 */
	protected $_productListTemplate = '';

	/**
	 * @param \Klymko\ProductImageSlider\Model\TemplateFactory         $templateFactory         
	 * @param \Klymko\ProductImageSlider\Model\OriginalTemplateFactory $originalTemplateFactory 
	 * @param \Klymko\ProductImageSlider\Helper\Data                   $dataHelper              
	 * @param \Magento\Framework\View\Asset\Repository                 $assetRepository         
	 * @param \Magento\Framework\View\Asset\GroupedCollection          $assetCollection         
	 * @param \Magento\Framework\View\Element\Template\Context         $context                 
	 * @param \Magento\Framework\Json\DecoderInterface                 $jsonDecoder             
	 * @param array                                                    $data                    
	 */
	public function __construct(
		\Klymko\ProductImageSlider\Model\TemplateFactory $templateFactory,
		\Klymko\ProductImageSlider\Model\OriginalTemplateFactory $originalTemplateFactory,
		\Klymko\ProductImageSlider\Helper\Data $dataHelper,
		\Magento\Framework\View\Asset\Repository $assetRepository,
		\Magento\Framework\View\Asset\GroupedCollection $assetCollection,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\DecoderInterface $jsonDecoder,
        array $data = []
	){
		$this->_templateFactory = $templateFactory;
		$this->_originalTemplateFactory = $originalTemplateFactory;
		$this->jsonDecoder = $jsonDecoder;
		$this->_dataHelper = $dataHelper;
		$this->_assetRepository = $assetRepository;
		$this->_assetCollection = $assetCollection;
        parent::__construct($context, $data);
	}

	/**
	 * Retrieve template block
	 * @return mixed
	 */
	public function getSelectedBlock()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $block = $objectManager->get('Klymko\ProductImageSlider\Block\Template\\' . ucfirst($this->getOriginalTemplate()->getCode()));
        return $block;
	}


	/**
	 * Retrieve template from configuration
	 * @return \Klymko\ProductIMageSlider\Model\Template
	 */
	public function getTemplate()
	{
		if ($this->_template === null) {
			$this->_template = $this->_templateFactory->create()->load($this->getCurrentTemplateId());
		}
		return $this->_template;
	}

	/**
	 * Get current template id
	 * @return int
	 */
	public function getCurrentTemplateId()
	{
		//Detecting current location
		//For category page get template from product list section of configuration
		if ($this->_request->getModuleName() == 'catalog' && $this->_request->getControllerName() == 'category') {
			return $this->_dataHelper->getProductListConfigTemplateId();
		}
		// For other case return template of product view page
		return $this->_dataHelper->getProductViewConfigTemplateId();
	}

	/**
	 * Retrieve json helper
	 * @return  \Magento\Framework\Json\DecoderInterface
	 */
	public function getJsonDecodeHelper()
	{
		return $this->jsonDecoder;
	}

	/**
	 * Retrive data helper
	 * @return \Klymko\ProductmageSlider\Helper\Data 
	 */
	public function getDataHelper()
	{
		return $this->_dataHelper;
	}

	/**
	 * Retrieve original template
	 * @return \Klymko\ProductImageSlider\Model\OriginalTemplate
	 */
	public function getOriginalTemplate()
	{
		if ($this->_originalTempalate === null) {
			$this->_originalTempalate = $this->_originalTemplateFactory->create()->load($this->getTemplate()->getTemplateId());
		}

		return $this->_originalTempalate;
	}

	/**
	 * Get path to template
	 * Using for product list
	 * @return string
	 */
	public function getProductListTemplate()
	{
		return $this->getOriginalTemplate()->getProductListTemplate();
	}
}
