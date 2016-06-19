<?php

namespace Klymko\ProductImageSlider\Model\Config\Source;

class Location
{
	/**
	 * {@inheritdoc}
	 * @return Array
	 */
	public function toOptionArray()
	{
		$result = [
			[
				'value'	=> 'catalog_category_view',
				'label'	=>	__('Category page')
			],
			[
				'value'	=> 'cms_index_index',
				'label'	=>	__('Home page')
			],
			[
				'value'	=>	'checkout_cart_index',
				'label'	=>  __('Checkout cart')

			],
			[
				'value'	=>	'wishlist_index_index',
				'label'	=>	__('Wishlist')
			],
			[
				'value'	=>	'catalog_product_view',
				'label'	=>	__('Product Page'),
				'title'	=>	__('Applied for related products, crossel products etc.')
			]
		];
		return $result;
	}
}