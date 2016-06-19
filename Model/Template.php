<?php

namespace Klymko\ProductImageSlider\Model;

class Template extends \Magento\Framework\Model\AbstractModel
{

	const TEMPLATE_STATUS_ENABLED = 1;
	const TEMPLATE_STATUS_DISABLED = 0;

    /**
     * Original template factory
     * @var Klymko\ProductImageSlider\Model\OriginalTemplateFactory
     */
    protected $_originalTemplateFactory;

    /**
     * Object Manager
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_objectManager;

    /**
     * Add otigin to select
     * @var boolean
     */
    protected $_addOriginToSelect = false;

    /**
     * Original template
     * @var Klymko\ProductImageSlider\Model\OriginalTemplate
     */
    protected $_originalTemplate;

    /**
     * Original template model
     * @var \Klymko\ProductImageSlider\Model\Template\AbstractTemplate
     */
    protected $_templateModel;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Klymko\ProductImageSlider\Model\OriginalTemplateFactory $originalTemplateFactory,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_originalTemplateFactory = $originalTemplateFactory;
        parent::__construct($context, $registry, $resource, $resourceCollection,$data);

    }

	/**
     * @return void
     */
    protected function _construct()
    {
    	$this->_init('Klymko\ProductImageSlider\Model\ResourceModel\Template');
    }

    /**
     * Get statuses
     * @return Array
     */
    public function getStatuses()
    {
    	return [self::TEMPLATE_STATUS_ENABLED => __("Enabled"), self::TEMPLATE_STATUS_DISABLED => __("Disabled")];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave()
    {
        if ($this->getTemplateId()) {
            $this->getTemplateModel()->prepareData($this);
        }

        return $this;
    }

    /**
     * Get template model
     * @return Klymko\ProductImageSlider\Model\Template\AbstactTemplate
     */
    public function getTemplateModel()
    {
        if ($this->_templateModel == null) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $this->_templateModel = $objectManager->get('Klymko\ProductImageSlider\Model\Template\\' . ucfirst($this->getOriginalTemplate()->getCode()));
        }

        return $this->_templateModel;
        
    }

    /**
     * Retrieve original template
     * @return Klymko\ProductImageSlider\Model\OriginalTemplate
     */
    public function getOriginalTemplate()
    {
        if ($this->_originalTemplate == null ) {
            $this->_originalTemplate = $this->_originalTemplateFactory->create()->load($this->getTemplateId());
        }
        return $this->_originalTemplate;
    }

    /**
     * {@inheritdoc}
     */
    protected function _afterLoad()
    {
        if ($this->_addOriginToSelect && $this->_originalTemplate === null) {
            $this->_originalTemplate = $this->_originalTemplateFactory->create()->load($this->getTemplateId());
            $this->setCode($this->_originalTemplate->getCode());
        }

        return parent::_afterLoad();
    }

    /**
     * Add original template data to select
     * @return  $this 
     */
    public function addOriginToSelect()
    {
        $this->_addOriginToSelect = true;
        return $this;
    }
}
