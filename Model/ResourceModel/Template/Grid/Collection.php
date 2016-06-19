<?php

namespace Klymko\ProductImageSlider\Model\ResourceModel\Template\Grid;

class Collection extends \Klymko\ProductImageSlider\Model\ResourceModel\Template\Collection
{

	protected function _beforeLoad()
	{
		$originalTemplateTable = $this->getTable('kl_product_image_slider_original_template');
		$this->getSelect()
			->joinLeft(['ot' => $originalTemplateTable], 'main_table.template_id = ot.id', ['original_title' => 'ot.title']);

		parent::_beforeLoad();
	}

}