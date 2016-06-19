<?php

namespace Klymko\ProductImageSlider\Controller\Adminhtml\Template;

class Delete extends \Klymko\ProductImageSlider\Controller\Adminhtml\Template
{

	/**
	 * {@inheritdoc}
	 */
	public function execute()
	{
		$ids = $this->_request->getParam('id');

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $error = false;
        try {
            foreach($ids as $id) {
                $this->_templateFactory->create()->setId($id)->delete();
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $error = true;
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $error = true;
            $this->messageManager->addException($e, __('We can\'t delete template right now. '.$e->getMessage()));
        }

        if (!$error) {
            $this->messageManager->addSuccess(
                __('Template(s) has been successfully deleted.')
            );
        }

        $this->_redirect('*/*');
	}
}
