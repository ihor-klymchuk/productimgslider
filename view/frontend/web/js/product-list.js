
define([
    "jquery"
], function($){
    "use strict";

    $.widget('productImgSlider.productList', {
        _create: function() {
			this._moveImagesFromA();
        },

        _moveImagesFromA: function() {
        	if ($(this.element).parents('a')) {
				var $parentA = $(this.element).parents('a');
				$parentA.before(this.element);
				$parentA.remove();
			}
        }
    });

    return $.productImgSlider.productList;
});