<?php

namespace Klymko\ProductImageSlider\Model\Config\Source;

class Template
{
	/**
	 * Template factory
	 * @var \Klymko\ProductImageSlider\Model\TemplateFactory
	 */
	protected $_templateFactory;

	/**
	 * @param \Klymko\ProductImageSlider\Model\TemplateFactory $templateFactory 
	 */
	public function __construct(
		\Klymko\ProductImageSlider\Model\TemplateFactory $templateFactory
	) {
		$this->_templateFactory = $templateFactory;
	}

	/**
	 * {@inheritdoc}
	 * @return Array
	 */
	public function toOptionArray()
	{
		$collection = $this->_templateFactory->create()
			->getCollection()
			->addFieldToFilter('status', \Klymko\ProductImageSlider\Model\Template::TEMPLATE_STATUS_ENABLED);

		$result = [''	=>	''];
		foreach ($collection as $item) {
			$result[$item->getId()] = $item->getTitle();
		}

		return $result;
	}
}