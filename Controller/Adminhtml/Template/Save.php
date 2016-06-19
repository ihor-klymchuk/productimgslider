<?php

namespace Klymko\ProductImageSlider\Controller\Adminhtml\Template;

class Save extends \Klymko\ProductImageSlider\Controller\Adminhtml\Template
{

	/**
	 * {@inheritdoc}
	 */
	public function execute()
	{
		if ($this->_request->isPost()) {
			$data = $this->_request->getParams();

			$template = $this->_templateFactory->create();
			if (isset($data['id'])) {
				$template->load($data['id']);
			} else {
			}

			try {
				$template->setData($data)
					->save();
	            if (isset($data['back'])) {
	                $this->_redirect('*/*/edit', ['id' => $template->getId()]);
	            } else {
	                $this->_redirect('*/*');
	            }

            	$this->messageManager->addSuccess(__('Template has been saved.'));

	            return;
	        } catch (\Magento\Framework\Exception\LocalizedException $e) {
	            $this->messageManager->addError(nl2br($e->getMessage()));
	        } catch (\Exception $e) {
	            $this->messageManager->addException($e, __('Something went wrong while saving this template.').' '.$e->getMessage());
	        }

        	$this->_redirect('*/*/edit', ['id' => $template->getId()]);
		}
		$this->_redirect('*/*/index');

	}

}