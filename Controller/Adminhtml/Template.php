<?php

namespace Klymko\ProductImageSlider\Controller\Adminhtml;

abstract class Template extends \Magento\Backend\App\Action
{

    protected $_registry;

    protected $_model;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Klymko\ProductImageSlider\Model\TemplateFactory $templateFactory
    ) {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->_templateFactory = $templateFactory;
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Klymko_ProductImageSlider::template');
    }

}