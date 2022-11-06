/**
 *
 *	[SOW] Dropdown
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	-
 *	@Usage			$.SOW.core.dropdown_click_ignore.init('.dropdown-menu.dropdown-click-ignore');
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
	var scriptInfo 		= 'SOW Dropdown Click Ignore';


	$.SOW.core.dropdown_click_ignore = {


		/**
		 *
		 *	@config
		 *
		 *
		 **/
		config: {},



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
			var __config 			= $.SOW.helper.check_var(config);

			this.selector 			= __selector[0]; 	// '#selector'
			this.collection 		= __selector[1]; 	// $('#selector')
			this.config 			= (__config !== null) ? $.extend({}, this.config, __config) : this.config;

			// in case the class is changed
			if(jQuery(this.selector).length < 1)
				return;


			// -- * --
			$.SOW.helper.consoleLog('Init : ' + scriptInfo);
			// -- * --


			// Stop clicks on empty dropdown links
			$.SOW.core.dropdown_click_ignore.stop_dd_empty_link($('.dropdown-menu a'));


			// 1. Has no selector
			if(!this.selector) {
				$.SOW.core.dropdown_click_ignore.process($(".dropdown-menu.dropdown-click-ignore"));
				return $(".dropdown-menu.dropdown-click-ignore");
			}


			// 2. Has selector
			return this.collection.each(function() {
				
				$.SOW.core.dropdown_click_ignore.process($(this));

			});


		},



		/**
		 *
		 *	@process
		 * 	keep a dropdown open on self container click
		 *
		 **/
		process: function(_this) {

			/*
				If any form is present inside dropdown,
				the dropdown will not close. 
				So we skip dropdowns with forms!

				Still is an issue on outside form click!!!
			*/
			if(jQuery('form', _this).length > 0) {

				// we try to use the same class inside!
				jQuery('.dropdown-click-ignore', _this).on('click', function(e) {
					e.stopPropagation();
				})

				return;
			}


			_this.on('click', function(e) {
				e.stopPropagation();
			});

		},




		/**
		 *
		 *	@stop_dd_empty_link
		 * 	Stop clicks on empty dropdown links
		 *
		 **/
		stop_dd_empty_link: function(_this) {

			_this.not('[data-toggle="collapse"]').on("click", function(e) {

				var _t 			= jQuery(this),
					_href 		= jQuery(this).attr('href') || '#';

				// prevent empty href click
				if(_href == '#' && !_t.hasClass('js-ignore'))
					e.preventDefault();

			});

		}

	};


})(jQuery);