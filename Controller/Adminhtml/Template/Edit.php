<?php

namespace Klymko\ProductImageSlider\Controller\Adminhtml\Template;

class Edit extends \Klymko\ProductImageSlider\Controller\Adminhtml\Template
{

	public function execute()
	{

		if (!$this->_request->getParam('template_id') && !$this->_request->getParam('id')) {
			$this->_redirect('*/*/new');
			return;
		}

		$model = $this->_templateFactory->create();
		if ($id = $this->_request->getParam('id')) {
			$model->load($id);
		}
		$this->_registry->register('current_model',$model);
		parent::execute();
	}



}