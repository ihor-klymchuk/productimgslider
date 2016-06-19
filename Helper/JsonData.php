<?php

namespace Klymko\ProductImageSlider\Helper;

class JsonData extends Data
{

	/**
	 * Encoded fields
	 * @var Array
	 */
	protected $_fields;


	/**
	 * Get fields
	 * @param  string $data
	 * @return Array
	 */
	public function getFields($data)
	{
		if ($this->_fields === null) {
			if (is_string($data)) {

			}	
		}

		return $this->_fields;
	}

}