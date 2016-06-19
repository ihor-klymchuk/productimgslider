<?php


namespace Klymko\ProductImageSlider\Block\Adminhtml\Template\Edit\Tab;

/**
 * Admin blog category edit form main tab
 */
class Config extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_model');
        $template = $this->_coreRegistry->registry('current_template');

        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('template_');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $block = $objectManager->get('Klymko\ProductImageSlider\Block\Adminhtml\Template\Edit\Tab\Template\\' . ucfirst($template->getCode()));

        $block->prepareForm($form, $template, $model);
        $this->setForm($form);        

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Configuration');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Configuration');
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
