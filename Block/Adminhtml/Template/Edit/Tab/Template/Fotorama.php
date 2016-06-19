<?php

namespace Klymko\ProductImageSlider\Block\Adminhtml\Template\Edit\Tab\Template;

class Fotorama extends AbstractTemplate
{

	/**
	 * Prepare form
	 * @param  Magento\Framework\Data\Form $fieldset 
	 * @param  Klymko\ProductImageSlider\Mode\OriginalTempalte $template 
	 * @param  Klymko\ProductImageSlider\Mode\Tempalte $model 
	 * @return $this
	 */
	public function prepareForm($form, $template, $model = null)
	{
		$fields = $this->_jsonHelper->jsonDecode($template->getFieldData());
		$this->_configData = $this->_jsonHelper->jsonDecode($model->getConfigData());


        $fieldset = $form->addFieldset('options', ['legend' => __('Default Options')]);

		foreach ($fields['options'] as $fieldName => $option) {
			$this->_createFields($fieldset, $fieldName, $option, 'options');
		}

        $fieldset = $form->addFieldset('option', ['legend' => __('Fullscreen Options')]);
        foreach ($fields['fullscreen'] as $fieldName => $option) {	
			$this->_createFields($fieldset, $fieldName, $option, 'fullscreen');
		}

	}
}
