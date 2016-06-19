<?php

namespace Klymko\ProductImageSlider\Model\Template;

class Fotorama extends AbstractTemplate
{

	/**
	 * Required css for this template
	 * @var array
	 */
	protected $_css = ['Klymko_ProductImageSlider::css/fotorama/product-list.css', 'mage/gallery/gallery.css'];

	/**
	 * {@inheritdoc}
	 */
	public function prepareData($template)
	{

		if ($template->getOptions() || $template->getFullscreen()) {
			$data = [
				'options' => $template->getOptions(),
				'fullscreen' => $template->getFullscreen()
			];

			$configData = $this->_jsonHelper->jsonEncode($data);
			$template->setConfigData($configData);
		}

		return $this;

	}
}