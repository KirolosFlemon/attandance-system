/**
 *
 *	[SOW] Dropdown
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	$.SOW.core.dropdown_click_ignore
 * 	@Usage 			$.SOW.core.dropdown.init('.dropdown-menu.dropdown-menu-hover');
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
	var scriptInfo 		= 'SOW Dropdown';


	$.SOW.core.dropdown = {


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


			// Update text on click
			$.SOW.core.dropdown.onClickUpdateText();


			if(jQuery(this.selector).length < 1)
				return;


			// Dependency Check
			if(typeof $.SOW.core.dropdown_click_ignore !== 'object')
				$.SOW.helper.consoleLog('[sow.dropdown] Missing [sow.dropdown_click_ignore]');


			// -- * --
			$.SOW.helper.consoleLog('Init : ' + scriptInfo);
			// -- * --


			$.SOW.core.dropdown.process(this.collection);
			return this.collection;

		},



		/**
		 *
		 *	@process

			@Fix|Hack
			MULTILEVEL DROPDOWN ON MOBILE 

			Issue: nested|multi level dropdowns are not supported in Bootstrap v3+

			So the issue is: we cannot use $().dropdown('hide|show|toggle') from documentation
			Bootstrap was developed for a single level, not multilevel.
			So we have to hack it somehow to allow multilevel, especially on mobile.

			Ugly but a necesity! 99% better than developing a new mega menu from scratch!


			NOTE: we ignore dropdowns without .dropdown-menu-hover
			Are working on click

		 *
		 **/
		process: function(_this) {

			_this.parent().find('.dropdown>a[data-toggle="dropdown"]').on('click', function(e) {

				var _t 				= jQuery(this);
					this.collection = _t;

				/* 

					Mobile devices only! 

				*/
				if($.SOW.globals.is_mobile === true) { 

					if(!_t.parent('.dropdown').hasClass('show')) {

						// first click : open
						$.SOW.core.dropdown.__ddBSControl(_t, 'show');

						// now close all other open parent dropdowns
						_t.parent('.dropdown').parent().find('.dropdown.show>a[data-toggle="dropdown"]').not(this).each(function() {
							$.SOW.core.dropdown.__ddBSControl(jQuery(this), 'hide');
						});

					} else {

						// second click : close
						$.SOW.core.dropdown.__ddBSControl(_t, 'hide');

						// now close all childs, if any
						_t.parent('.dropdown').find('.dropdown-menu .dropdown>a[data-toggle="dropdown"]').each(function(e) {
							$.SOW.core.dropdown.__ddBSControl(jQuery(this), 'hide');
						});

					}

					// Stop here, block bootstrap to run its dropdowns stuff
					e.stopPropagation();

				}

			});

		},



		/**
		 *
		 *	@__ddBSControl
		 *	:: Helper
		 *
		 **/
		__ddBSControl: function(_t, status) {

			if(status == 'show') {

				_t.attr('aria-expanded','true').parent('.dropdown').addClass('show');
				_t.next('.dropdown-menu').addClass('show');

			} else {

				_t.attr('aria-expanded','false').parent('.dropdown').removeClass('show');
				_t.next('.dropdown-menu').removeClass('show');


			}

		},






		/**
		 *
		 *	@onClickUpdateText
		 *
		 *
		 **/
		onClickUpdateText: function() {

			jQuery('.dropdown-menu-click-update a.dropdown-item, .dropdown-menu-click-update a.dropdown-link').not('.js-dropdown-triggerified').addClass('js-dropdown-triggerified').on('click', function(e) {

				var _t 			= jQuery(this);

				var dropdownContainer = _t.parents('.dropdown-menu-click-update');
				jQuery('a.dropdown-item, a.dropdown-link', dropdownContainer).removeClass('active');
				_t.addClass('active');


				// find button trigger & update text
				var dropdownBtnTrigger = dropdownContainer.parent().find('[data-toggle="dropdown"]');
				if(dropdownBtnTrigger) {
					var dropdownBtnTextToUpdate = jQuery('.js-trigger-text', _t).text();
					if(dropdownBtnTextToUpdate)
						jQuery('.js-trigger-text', dropdownBtnTrigger).text(dropdownBtnTextToUpdate);
				}



				setTimeout(function() {

					// Close dropdown on link click
					// if no .dropdown-click-ignore is present
					if(!dropdownContainer.hasClass('dropdown-click-ignore') && dropdownContainer.hasClass('show'))
						dropdownContainer.dropdown('hide');

					// Callback
					var callBack = dropdownContainer.attr('data-dropdown-callback') || '';
					if(callBack != '') {
						if(typeof window[callBack] === 'function')
							window[callBack](_t.attr('href'));
					}

				}, 0);

				e.preventDefault();

			});

			return true;
		}
		
	};


})(jQuery);