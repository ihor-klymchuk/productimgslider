<?php

namespace Klymko\ProductImageSlider\Model\Template;

abstract class AbstractTemplate extends \Magento\Framework\Model\AbstractModel
{

	/**
	 * Json Helper
	 * @var \Magento\Framework\Json\Helper\Data
	 */
	protected $_jsonHelper;

	/**
	 * Required css for functionalit of template
	 * @var Array
	 */
	protected $_css;

	/**
	 * @param \Magento\Framework\Json\Helper\Data                          $jsonHelper         
	 * @param \Magento\Framework\Model\Context                             $context            
	 * @param \Magento\Framework\Registry                                  $registry           
	 * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource           
	 * @param \Magento\Framework\Data\Collection\AbstractDb|null           $resourceCollection 
	 * @param array                                                        $data               
	 */
	public function __construct(
    	\Magento\Framework\Json\Helper\Data $jsonHelper,
		\Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
	) {
		$this->_jsonHelper = $jsonHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection,$data);
	}

	/** 
	 * Prepare config data before save
	 * @param  Klymko\ProductImageSlider\Model\Template
	 * @return string Converted to json string
	 */
	public function prepareData($template) {}
	
	/**
	 * Retrieve required css files
	 * @return Array
	 */
	public function getRequiredCss()
	{
		return $this->_css;
	}
}