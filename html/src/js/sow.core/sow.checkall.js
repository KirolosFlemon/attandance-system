/**
 *
 *	[SOW] Check All
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	-
 *	@Usage			$.SOW.core.checkall.init('.checkall');
 * 
 *
 **/
;(function ($) {
	'use strict';


	/**
	 *
	 *	@vars
	 *
	 *
	 **/
	var scriptInfo 		= 'SOW Check All';


	$.SOW.core.checkall = {


		/**
		 *
		 *	@collection
		 *
		 *
		 **/
		collection: $(),



		/**
		 *
		 *	@init
		 * 	
		 *
		 **/
		init: function (selector, config) {

			var __selector 			= $.SOW.helper.__selector(selector);
			this.selector 			= __selector[0]; 	// '#selector'
			this.collection 		= __selector[1]; 	// $('#selector')


			if(jQuery(this.selector).length < 1)
				return;

			// -- * --
			$.SOW.helper.consoleLog('Init : ' + scriptInfo);
			// -- * --


			$.SOW.core.checkall.process(this.collection);
			return null;

		},



		/**
		 *
		 *	@process
		 * 	
		 *
		 **/
		process: function(_this) {

			this.collection.on('click', function () {
				var _target = jQuery(this).data('checkall-container');

				jQuery(_target + ' input:checkbox').not(this).prop('checked', this.checked);

				// when starting to deselect some checboxes, remove checkall 
				jQuery(_target + ' input:checkbox').bind("click", function () {
				
					if(!jQuery(this).is(":checked")) {
						jQuery('input.checkall[data-checkall-container="'+_target+'"]').prop('checked', false);
					}

				});


				// other checkall
				if(jQuery(this).is(":checked")) {
					jQuery('input.checkall[data-checkall-container="'+_target+'"]').prop('checked', true);
				} else {
					jQuery('input.checkall[data-checkall-container="'+_target+'"]').prop('checked', false);
				}

			});

		},


	};


})(jQuery);