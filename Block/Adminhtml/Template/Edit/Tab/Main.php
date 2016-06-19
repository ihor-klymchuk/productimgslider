<?php


namespace Klymko\ProductImageSlider\Block\Adminhtml\Template\Edit\Tab;

/**
 * Admin blog category edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{

    /**
     * Original template factory
     * @var \Klymko\ProductImageSlider\Model\OriginalTemplateFactory
     */
    protected $_originalTemplateFactory;

    /**
     * Original template
     * @var Klymko\ProductImageSlider\Model\OriginalTemplate
     */
    protected $_originalTemplate;

    /**
     * @param \Klymko\ProductImageSlider\Model\OriginalTemplateFactory $originalTemplateFactory 
     * @param \Magento\Backend\Block\Template\Context                  $context                 
     * @param \Magento\Framework\Registry                              $registry                
     * @param \Magento\Framework\Data\FormFactory                      $formFactory             
     * @param array                                                    $data                    
     */
    public function __construct(
        \Klymko\ProductImageSlider\Model\OriginalTemplateFactory $originalTemplateFactory,
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
        $model = $this->_coreRegistry->registry('current_model');

        /*
         * Checking if user have permissions to save information
         */
        $isElementDisabled = !$this->_isAllowedAction('Klymko_ProductImageSlider::template');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ],
            ]
            );

        $form->setHtmlIdPrefix('template_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Template Information')]);

        if (!$model->getTemplateId()) {
            $model->setTemplateId($this->_request->getParam('template_id'));
        }

        $fieldset->addField('template_id', 'hidden', ['name' => 'template_id']);


        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'tempate_id',
            'note',
            [
                'label' => __('Template'),
                'title' => __('Template'),
                'text' => $this->_getOriginalTemplate($model->getTemplateId())->getTitle()
            ]
        );

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => $model->getStatuses(),
                'disabled' => $isElementDisabled
            ]
        );

        $this->_eventManager->dispatch('klymko_productimgslider_template_edit_tab_main_prepare_form', ['form' => $form]);

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Get original template
     * @return Klymko\ProductImageSlider\Model\OriginalTemplate
     */
    protected function _getOriginalTemplate($templateId)
    {
        if ($this->_originalTemplate === null) {
            $this->_originalTemplate = $this->_originalTemplateFactory->create()->load($templateId);

            $this->_coreRegistry->register('current_template', $this->_originalTemplate);

        }

        return $this->_originalTemplate;
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
