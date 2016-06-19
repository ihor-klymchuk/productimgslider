<?php


namespace Klymko\ProductImageSlider\Block\Adminhtml\Template;

/**
 * Admin blog category
 */
class NewTemplate extends \Magento\Backend\Block\Widget\Form\Container
{

    /**
     * Initialize cms page edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Klymko_ProductImageSlider';
        $this->_controller = 'adminhtml_template';
        $this->_mode = "newTemplate";

        parent::_construct();

        $this->buttonList->remove('reset');
        $this->buttonList->remove('delete');

        $this->buttonList->update('save','label', 'Create');

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

    /**
     * Get creating url
     * @return string 
     */
    public function getCreateUrl()
    {
        return $this->getUrl('adminhtml/*/edit', ['template_id' => '%template_id%']);
    }
}
