<?php

namespace Klymko\ProductImageSlider\Block\Adminhtml\Template\Edit\Tab\Template;

class AbstractTemplate extends \Magento\Backend\Block\Widget\Form\Generic
{
	/**
	 * Json Helper
	 * @var \Magento\Framework\Json\Helper
	 */
	protected $_jsonHelper;

	/**
	 * Config Data
	 * @var Array
	 */
	protected $_configData;

	/**
	 * @param \Magento\Framework\Json\Helper\Data     $jsonHelper  
	 * @param \Magento\Backend\Block\Template\Context $context     
	 * @param \Magento\Framework\Registry             $registry    
	 * @param \Magento\Framework\Data\FormFactory     $formFactory 
	 * @param array                                   $data        
	 */
    public function __construct(
    	\Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
    	$this->_jsonHelper = $jsonHelper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

	/**
	 * Prepare form
	 * @param  Magento\Framework\Data\Form $fieldset 
	 * @param  Klymko\ProductImageSlider\Mode\OriginalTempalte $template 
	 * @param  Klymko\ProductImageSlider\Mode\Tempalte $model 
	 * @return $this
	 */
	public function prepareForm($form, $template, $model = null)
	{}

	/**
	 * Adding fields to fieldset from data
	 * @param  Magento\Framework\Data\Form\Element\Fieldset $fieldset 
	 * @param  string $fieldName
	 * @param  string $option
	 * @param  string $group
	 * @return $this
	 */
	protected function _createFields($fieldset, $fieldName, $option, $group)
	{
		if (!isset($option['default'])) {
			$option['default'] = null;
		}
		if (!empty($option['params'])) {
			    $fieldset->addField(
		            $group . '_' .$fieldName,
		            'select',
		            [
		                'label' => __($option['title']),
		                'title' => __($option['title']),
		                'name' => $group . '[' . $fieldName . ']',
	                	'value' => (isset($this->_configData[$group][$fieldName])) ? $this->_configData[$group][$fieldName] : $option['default'],
		                'required' => true,
		                'options' => $this->_paramsToOption($option['params'])
		            ]
		        );
		} else {
			$fieldset->addField(
	            $group . '_' .$fieldName,
	            'text',
	            [
	                'name' => $group . '[' . $fieldName . ']',
	                'label' => __($option['title']),
	                'title' => __($option['title']),
	                'value' => (isset($this->_configData[$group][$fieldName])) ? $this->_configData[$group][$fieldName] : $option['default'],
	                'required' => true
	            ]
	        );
		}

		return $this;
	}

	/**
	 * Params to options
	 * @param  Array $params
	 * @return Array
	 */
	protected function _paramsToOption($params)
	{
		$array = [];
		foreach ($params as $param) {
			$array[$param['value']] = $param['title'];
		}


		return $array;
	}

}