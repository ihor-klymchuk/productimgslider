<?php

namespace Klymko\ProductImageSlider\Block\Adminhtml\Template\NewTemplate;

/**
 * Admin blog category edit form form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * Original template factory
     * @var \Klymko\ProductImageSlider\Model\OriginalTemplateFactory
     */
    protected $_originalTemplateFactory;

    /**
     * @param \Klymko\ProductImageSlider\Model\OriginalTemplate $originalTemplateFactory 
     * @param \Magento\Backend\Block\Template\Context           $context                 
     * @param \Magento\Framework\Registry                       $registry                
     * @param \Magento\Framework\Data\FormFactory               $formFactory             
     * @param array                                             $data                    
     */
    public function __construct(
        \Klymko\ProductImageSlider\Model\OriginalTemplate $originalTemplateFactory,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->_originalTemplateFactory = $originalTemplateFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl('*/*/edit'), 'method' => 'post']]
        );
        $form->setUseContainer(true);

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Select template')]);

        $fieldset->addField(
            'tempate_id',
            'select',
            [
                'label' => __('Template'),
                'title' => __('Template'),
                'name' => 'template_id',
                'required' => true,
                'options' => $this->_originalTemplateFactory->toOptionArray()
            ]
        );

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
