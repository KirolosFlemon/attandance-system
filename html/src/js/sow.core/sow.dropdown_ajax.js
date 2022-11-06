/**
 *
 *	[SOW] Dropdown Ajax
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	$.SOW.core.dropdown_click_ignore
 * 					$.SOW.core.dropdown
 * 	@Usage 			$.SOW.core.dropdown_ajax.init('a[data-toggle="dropdown"]');
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
	var scriptInfo 		= 'SOW Dropdown Ajax';
	var ddTimeKepper 	= {};


	$.SOW.core.dropdown_ajax = {


		/**
		 *
		 *	@config
		 *
		 *
		 **/
		config: {

			// general
			loading_icon: 			'fi fi-circle-spin fi-spin',
			clearCacheInterval: 	1000 * 60, 	// 1 min


			// json only : dropdown strating|ending tags
			tpl_start: 				'<ul class="list-unstyled m-0 p-0">',
			tpl_end: 				'</ul>',

			tpl_ItemStart: 			'<li class="dropdown-item">',
			tpl_ItemStartWChilds: 	'<li class="dropdown-item dropdown">',
			tpl_ItemEnd: 			'</li>',

			tpl_Child_Start: 		'<ul class="dropdown-menu dropdown-menu-hover dropdown-menu-block-md shadow-lg b-0 m-0">',
			tpl_Divider: 			'<li class="dropdown-divider"></li>',

		},



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
			this.selector_orig 		= __selector[2]; 	// $('#selector') // without ajax container prefix
			this.config 			= (__config !== null) ? $.extend({}, this.config, __config) : this.config;


			if(jQuery(this.selector).length < 1)
				return;


			// -- * --
			$.SOW.helper.consoleLog('Init : ' + scriptInfo);
			// -- * --


			$.SOW.core.dropdown_ajax.process(this.collection);
			return this.collection;

		},



		/**
		 *
		 *	@process
		 *
		 **/
		process: function(_this) {

			// Required
			if(_this.data('dropdown-ajax-source') == '')
				return;


			// Initial Setup
			if($.SOW.globals.is_mobile === true) {

				var jQ_actions = 'click';

			} else {

				var jQ_actions = 'click mouseover';

				// Hover only, remove click
				if(_this.next().closest('.dropdown-menu').hasClass('dropdown-menu-hover'))
					var jQ_actions = 'mouseover';

			}


			// Repopulate dropdowns from cache, if exists
			$.SOW.core.dropdown_ajax.repopulateFromCache();


			// mouse over|click
			_this.on(jQ_actions, function(e) {

				var _t 					= jQuery(this),
					_source 			= _t.data('dropdown-ajax-source') 			|| '',
					_mode 				= _t.data('dropdown-ajax-mode') 			|| 'html',	// html|json
					_clearCacheInterval	= _t.data('dropdown-ajax-refresh-interval') || $.SOW.core.dropdown_ajax.config.clearCacheInterval,
					_reloadAlways 		= _t.data('dropdown-ajax-reload-always') 	|| false,
					_loadIcon 			= _t.data('dropdown-ajax-loadicon') 		|| $.SOW.core.dropdown_ajax.config.loading_icon,
					_container 			= _t.next().closest('.dropdown-menu') 		|| '',
					_useCache 			= _t.attr('data-dropdown-ajax-cache') 		|| 'false',
					_containerID 		= _container.attr('id')						|| '',
					_method				= _t.data('dropdown-ajax-method') 			|| 'GET',
					_contentType		= _t.data('dropdown-ajax-contentType') 		|| '',
					_dataType			= _t.data('dropdown-ajax-dataType') 		|| '';


				if(_source == '' || _container == '')
					return;


				// Add an ID to dropdown container if empty
				if(_containerID == '') {
					var _containerID = 'rand_' + $.SOW.helper.randomStr(8);
					_container.attr('id', _containerID);
				}


				// Cached? Check expired
				if(_useCache+'' == 'true' && _t.hasClass('js-cached')) {
					var $continue = $.SOW.core.dropdown_ajax.validateCache(_source);
					if($continue === false)
						return;
				}


				/*
					force : overwrite
					do not reload data on mouse over
				*/
				if(jQ_actions == 'mouseover' && $.SOW.globals.is_mobile === false)
					_reloadAlways = false;


				// Refresh Interval!
				if(_reloadAlways == false && _clearCacheInterval > 0)
					$.SOW.core.dropdown_ajax.process_clearCacheInterval(_t, _containerID, _clearCacheInterval);


				// Content already successfully loaded and reload on each click|show is disabled
				if(_reloadAlways == false && _t.hasClass('js-dropdownified'))
					return;


				// set initialized
				_container.addClass('js-dropdownified');


				// Ajax
				jQuery.ajax({
					url:			_source,
					data: 			(_mode === 'json') ? {} : {ajax:"true"},
					type: 			_method,
					contentType: 	_contentType 	|| 'application/x-www-form-urlencoded; charset=UTF-8',
					dataType: 		_dataType 		|| null,
					headers: 		'',
					crossDomain: 	'',

					beforeSend: function() {

						_container.html('<div class="js-dd-ajax-loader text-center rounded p-3"><i class="' + _loadIcon + ' h5 text-gray-400"></i></div>');

					},

					error: 	function(XMLHttpRequest, textStatus, errorThrown) {

						if(typeof $.SOW.core.toast === 'object') {

							$.SOW.core.toast.show('danger', '404 Error', 'Unexpected Internal error!', 'bottom-center', 0, true);

						} else {

							// alert("[404] Unexpected internal error!");

						}

						// if debug enabled, see config
						if($.SOW.config.sow__debug_enable === true) { // optional, just to skip so many callings
							$.SOW.helper.consoleLog('----------------------------');
							$.SOW.helper.consoleLog('--- AJAX  DROPDOWN ERROR ---');
							$.SOW.helper.consoleLog('1. XMLHttpRequest:');
							$.SOW.helper.consoleLog(XMLHttpRequest);
							$.SOW.helper.consoleLog('2. textStatus:');
							$.SOW.helper.consoleLog(textStatus);
							$.SOW.helper.consoleLog('3. errorThrown:');
							$.SOW.helper.consoleLog(errorThrown);
							$.SOW.helper.consoleLog('----------------------------');
						}

					},

					success: function(data) {

						_t.addClass('js-dropdownified');

						/* json */
						if(_mode === 'json')
							var data = $.SOW.core.dropdown_ajax.process_json(data);

						// push data
						_container.html(data);


						// Add to cache
						if(_useCache+'' == 'true')
							$.SOW.core.dropdown_ajax.addToCache(_source, data);


						/*
							Reinits [mobile required]
						*/
						// SOW :: Dropdown
						if(typeof $.SOW.core.dropdown === 'object')
							$.SOW.core.dropdown.process(_container);

						// SOW :: Dropdown Click Ignore
						if(typeof $.SOW.core.dropdown_click_ignore === 'object') {
							var _containerLinks = $('a', _container);
							$.SOW.core.dropdown_click_ignore.stop_dd_empty_link(_containerLinks);
						}

						// SOW :: Ajax Navigation
						if(typeof $.SOW.core.ajax_navigation === 'object')
							$.SOW.core.ajax_navigation.__initFor('#' + _containerID);


						// -- * --
						$.SOW.helper.consoleLog('[#'+_containerID+'] Dropdown Ajax Content Loaded! ' + _source, 'color: #999999;');
						// -- * --


						// Reinit Plugins : HTML only
						if(_mode == 'html') {
							var _target = '#'+_containerID;

							// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
							// reinit inside ajax container
							if($.SOW.config.sow__debug_enable === true) { // just to avoid always calling the helper
								$.SOW.helper.consoleLog('+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
								$.SOW.helper.consoleLog(scriptInfo, 'color: #6dbb30; font-weight: bold; font-size:14px;');
								$.SOW.helper.consoleLog('Ajax Reinit For: ' + _target);
								$.SOW.helper.consoleLog(window.location.href);
								$.SOW.helper.consoleLog('+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
							}

							$.SOW.reinit(_target);
							// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

						}

					}

				});

			});

		},




		/**
		 *
		 *	@process_json
		 *
		 * 	
		 *
		 **/
		process_json: function(data) {

			try {

				var _data = JSON.parse(data);

			} catch(err) {

				var _data = data;

			}

			/* --------------------------------- */
			var _tpl  = ''; 
				_tpl += $.SOW.core.dropdown_ajax.config.tpl_start;
				_tpl += $.SOW.core.dropdown_ajax.process_json_build_tree(_data);
				_tpl += $.SOW.core.dropdown_ajax.config.tpl_end;
			/* --------------------------------- */


			return _tpl;

		},




		/**
		 *
		 *	@process_json_build_tree
		 * 	Recursive
		 * 	
		 *
		 **/
		process_json_build_tree: function(data) {
			
			var _tpl = '';

			if(typeof data === 'undefined') 
				return _tpl;

			for (var i = 0; i < data.length; i++) {

				/* 0. Divider -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				if(typeof data[i].divider !== 'undefined' && data[i].divider === true) {
					_tpl += $.SOW.core.dropdown_ajax.config.tpl_Divider;
					continue;
				}
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */


				/* 1. Text -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				else if(typeof data[i].text !== 'undefined' && data[i].text.length > 0) {
					_tpl += $.SOW.core.dropdown_ajax.config.tpl_ItemStart + data[i].text + $.SOW.core.dropdown_ajax.config.tpl_ItemEnd;
					continue;
				}
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */



				var has_childs 		= (typeof data[i].childs !== 'undefined' && data[i].childs.length > 0) ? true : false;


				/* 2. tpl start <li> -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				_tpl 				+= (has_childs === true) ? $.SOW.core.dropdown_ajax.config.tpl_ItemStartWChilds :  $.SOW.core.dropdown_ajax.config.tpl_ItemStart;
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */



				/* 3. add link -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				var _childsTag 		 = (has_childs === true) ?  ' data-toggle="dropdown"' : '';

				var _class 	 		 = (typeof data[i].class 	!== 'undefined' && data[i].class != '')			? ' ' + data[i].class 	: '';
					_class 	 		+= (typeof data[i].active 	!== 'undefined' && data[i].active == true) 		? ' active' 			: '';
					_class 	 		+= (typeof data[i].disabled !== 'undefined' && data[i].disabled == true) 	? ' disabled' 			: '';

				var _icon 	 		 = (typeof data[i].icon 	!== 'undefined' && data[i].icon != '') 			? '<i class="'+data[i].icon+'"></i>' : '';
				var _target 	 	 = (typeof data[i].target 	!== 'undefined' && data[i].target != '')		? ' target="'+data[i].target+'"' : '';

				_tpl 				+= '<a href="'+data[i].url+'" class="dropdown-link' + _class + '"' + _childsTag + _target+'>' + _icon + data[i].label + '</a>';
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */



				/* 4. recursive childs  -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				if(has_childs === true) {
					_tpl 			+= $.SOW.core.dropdown_ajax.config.tpl_Child_Start;
					_tpl 			+= $.SOW.core.dropdown_ajax.process_json_build_tree(data[i].childs);
					_tpl 			+= $.SOW.core.dropdown_ajax.config.tpl_end;
				}
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */



				/* 5. tpl end </li>  -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
				_tpl 				+= $.SOW.core.dropdown_ajax.config.tpl_ItemEnd;
				/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

			}


			/* return final tpl */
			return _tpl;
		},




		/**
		 *
		 *	@process_clearCacheInterval
		 * 	
		 * 	
		 *
		 **/
		process_clearCacheInterval: function(_t, _containerID, _clearCacheInterval) {

			var timestampNow = new Date().getTime();

			// First click/hover
			// Refresh : Cache Added!
			if(typeof ddTimeKepper[_containerID] === 'undefined')
				ddTimeKepper[_containerID] = timestampNow;

			// Cache Refreshed & Content Reloaded
			else if((timestampNow - ddTimeKepper[_containerID]) > _clearCacheInterval) {
				ddTimeKepper[_containerID] = timestampNow;
				_t.removeClass('js-dropdownified');
			}

		},







		/**
		 *
		 *	@addToCache
		 *
		 **/
		addToCache: function(_URL, data) {

			// Skip
			if(jQuery('body[data-dropdown-ajax-cache-ignore="true"]').length > 0) {
				localStorage.removeItem('cachedDropdowns');
				return;
			}

			// Get from cache!
			var cachedDropdowns 	= localStorage.getItem("cachedDropdowns");
			var cachedDropdownsArr 	= (cachedDropdowns) ? JSON.parse(cachedDropdowns) : {};

			// create a hash from URL
			var hash = $.SOW.helper.strhash(_URL);
			var timestampNow = new Date().getTime();

			cachedDropdownsArr[hash] = { url:_URL, html:data, timestamp:timestampNow }
			localStorage.setItem("cachedDropdowns", JSON.stringify(cachedDropdownsArr));

			return true;

		},



		/**
		 *
		 *	@repopulateFromCache
		 *
		 **/
		repopulateFromCache: function() {

			// Skip
			if(jQuery('body[data-dropdown-ajax-cache-ignore="true"]').length > 0)
				return;

			// Get from cache!
			var cachedDropdowns = localStorage.getItem("cachedDropdowns");
			if(!cachedDropdowns)
				return false;

			// Array conversion
			var cachedDropdownsArr = JSON.parse(cachedDropdowns);
			for(var key in cachedDropdownsArr) {
				jQuery('[data-dropdown-ajax-source="'+cachedDropdownsArr[key]['url']+'"]').addClass('js-cached').next().closest('.dropdown-menu').html(cachedDropdownsArr[key]['html']);
			}

			return true;
		},






		/**
		 *
		 *	@validateCache
		 *
		 **/
		validateCache: function(_URL) {

			// Get from cache!
			var cachedDropdowns 	= localStorage.getItem("cachedDropdowns");
			if(!cachedDropdowns)
				return true; // true = continue

			// Parse cache & create hash from url
			var cachedDropdownsArr 	= JSON.parse(cachedDropdowns);
			var hash 				= $.SOW.helper.strhash(_URL);

			// Cache Refreshed & Content Reloaded
			var timestampNow = new Date().getTime();
			if((timestampNow - cachedDropdownsArr[hash]['timestamp']) > 60*30) {
						cachedDropdownsArr[hash] = {};
				delete 	cachedDropdownsArr[hash];

				// reset
				localStorage.setItem("cachedDropdowns", JSON.stringify(cachedDropdownsArr));
				return true; // true = continue

			}

			return false; // false = stop, cache is valid!

		},





	};


})(jQuery);