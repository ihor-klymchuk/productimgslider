<?php

namespace Klymko\ProductImageSlider\Controller\Adminhtml\Template;

class MassStatus extends \Klymko\ProductImageSlider\Controller\Adminhtml\Template
{

	/**
	 * {@inheritdoc}
	 */
	public function execute()
    {
        $ids = $this->getRequest()->getParam('id');
        
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $error = false;

        try {

            $status = $this->_request->getParam('status');

            if (is_null($status)) {
                throw new Exception(__('Parameter "Status" missing in request data.'));
            }

            foreach($ids as $id) {
                $this->_templateFactory->create()
                    ->load($id)
                    ->setData('status', $status)
                    ->save();
            }

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $error = true;
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $error = true;
            $this->messageManager->addException($e, __('We can\'t change status of template right now. '.$e->getMessage()));
        }

        if (!$error) {
            $this->messageManager->addSuccess(
                __('Template(s) status have been changed.')
            );
        }

        $this->_redirect('*/*');

    }
}
