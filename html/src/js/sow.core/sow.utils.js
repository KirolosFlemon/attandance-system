/**
 *
 *	[SOW] Utils
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	-
 *	@Usage			$.SOW.core.utils.init();
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
	var scriptInfo 		= 'SOW Utils';
	var timeAgoList 	= [];
	var slideshowList 	= {};

	$.SOW.core.utils = {


		/**
		 *
		 *	@config
		 *
		 *
		 **/
		config: {

			// selectors
			selector__initialFromString 			: '.sow-util-initials',
			selector__timeAgo 						: '.sow-util-timeago',
			selector__cookie 						: '.sow-util-cookie',
			selector__slideshow 					: '.sow-util-slideshow',
			selector__cloner 						: '.sow-util-cloner',
			selector__action 						: '.sow-util-action',

			// ajax function
			method 									: 'GET',
			contentType 							: '', 	// jQuery params
			dataType 								: '', 	// jQuery params
			headers 								: '', 	// jQuery params
			crossDomain 							: '', 	// jQuery params
			data_params 							: {ajax:'true'},


			lang__timeAgo 							: {
															seconds 		: "less than a minute ago",
															minute 			: "about a minute ago",
															minutes 		: "%d minutes ago",
															hour 			: "about an hour ago",
															hours 			: "about %d hours ago",
															day 			: "a day ago",
															days 			: "%d days ago",
															month 			: "about a month ago",
															months 			: "%d months ago",
															year 			: "about a year ago",
															years 			: "%d years ago"
														},
		},



		/**
		 *
		 *	@init
		 * 	
		 *
		 **/
		init: function (selector, config) {

			var __selector 			= $.SOW.helper.__selector(selector);
			this.selector 			= __selector[0]; 	// '#selector'

			// Initials from a string [name]
			$.SOW.core.utils.initialsFromString(this.selector+' '+$.SOW.core.utils.config.selector__initialFromString);
			
			// Time Ago
			$.SOW.core.utils.timeAgo(this.selector+' '+$.SOW.core.utils.config.selector__timeAgo);

			// Cookies
			$.SOW.core.utils.cookieUtil(this.selector+' '+$.SOW.core.utils.config.selector__cookie);

			// Background Slideshow
			$.SOW.core.utils.slideshow(this.selector+' '+$.SOW.core.utils.config.selector__slideshow);

			// Cloner
			$.SOW.core.utils.cloner(this.selector+' '+$.SOW.core.utils.config.selector__cloner);

			// Hide/Show/Readonly/Disable
			$.SOW.core.utils.UtilAction(this.selector+' '+$.SOW.core.utils.config.selector__action);

			return null;

		},



		/**
		 *
		 *	@initialsFromString
		 * 	
		 *
		 **/
		initialsFromString: function(selector) {

			var el 		= jQuery(selector),
				loaded 	= false;

			if(el.length < 1)
				return;


			el.not('.js-sowformstringified').addClass('js-sowformstringified').each(function(selector) {

				var _t 			= jQuery(this),
					fullName 	= _t.data('initials') 						|| '',
					assignColor = jQuery(this).attr('data-assign-color') 	|| 'false';
				
				if(fullName == '')
					return false;


				// Assign color by name
				if(assignColor+'' == 'true') {

					var hash 	= 0,
						s 		= 70,	// saturation
						l 		= 90;	// lightness

					for (var i = 0; i < fullName.length; i++) {
						hash = fullName.charCodeAt(i) + ((hash << 5) - hash);
					}

					var h = hash % 360;
					_t.removeClass('bg-light').css({"background":'hsl('+h+', '+s+'%, '+l+'%)'});

				}


				// Extract Initials
				var initials = fullName.match(/\b\w/g) || [];
					initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();


				// Push & remove ununsed!
				_t.text(initials).removeAttr('data-initials data-assign-color');
				loaded = true;

			});


			// -- * --
			if(loaded === true)
				$.SOW.helper.consoleLog('Init : ' + scriptInfo + ' : Initials From String');
			// -- * --

		},




		/**
		 *
		 *	@timeAgo
		 * 	inspired from jQuery timeago
		 * 	https://timeago.yarp.com/jquery.timeago.js
		 *
		 *
		 **/
		timeAgo: function(selector) {

			var el 		= jQuery(selector),
				loaded 	= false;
			
			if(el.length < 1)
				return;

			/**

				You can also set once an empty element if you have many timeago's.
				Example: &lt;span class="sow-util-timeago-lang" data-lang-timeago='{}'>
				Set it anywhere - bottom, etc!

			**/
			var langBySpan = jQuery('span.sow-util-timeago-lang').data('lang') || '';
			if(typeof langBySpan === 'object')
				$.SOW.core.utils.config.lang__timeAgo = langBySpan;

			if(typeof sow_util_timeago_lang === 'object')
				$.SOW.core.utils.config.lang__timeAgo = sow_util_timeago_lang;
			// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --


			el.not('.js-sowtimeagofied').addClass('js-sowtimeagofied').each(function(selector) {

				var _t 		= jQuery(this),
			    	time 	= _t.data('time') 	|| _t.attr('datetime'),
			    	live 	= _t.attr('live') 	|| 'false',
			    	lang 	= _t.data('lang') 	|| '',
			    	ID 		= _t.attr('id')		|| '';
				
				if(!time) 
					return

				if(typeof lang === 'object')
					$.SOW.core.utils.config.lang__timeAgo = lang;

				if(ID == '') {
					var ID = 'rand_' + $.SOW.helper.randomStr(3, 'N');
					_t.attr('id', ID);
				}


				$.SOW.core.utils.timeAgoLooper(_t, ID); // on load

				// update time every minute
				if(live+'' == 'true') {
					timeAgoList[ID] = setInterval(function() {
						$.SOW.core.utils.timeAgoLooper(_t, ID);
					}, 60000);
				}

				loaded == true;

			});


			// -- * --
			if(loaded === true)
				$.SOW.helper.consoleLog('Init : ' + scriptInfo + ' : Time Ago');
			// -- * --

		},
			timeAgoLooper: function(_t, ID) {

				var time 		= _t.data('time') || _t.attr('datetime');
			    var templates 	= $.SOW.core.utils.config.lang__timeAgo;
			    var template 	= function (t, n) {
			        return templates[t] && templates[t].replace(/%d/i, Math.abs(Math.round(n)));
			    };

				// parse iso8601
				if(typeof time === 'string') { // timestamp skipped!

					time = time.replace(/\.\d+/,""); // remove milliseconds
					time = time.replace(/-/,"/").replace(/-/,"/");
					time = time.replace(/T/," ").replace(/Z/," UTC");
					time = time.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"); // -04:00 -> -0400
					time = time.replace(/([\+\-]\d\d)$/," $100"); // +09 -> +0900

				}

				var time 		= new Date(time * 1000 || time);
				var now 		= new Date();
				var seconds 	= ((now.getTime() - time) * .001) >> 0;
				var minutes 	= seconds / 60;
				var hours 		= minutes / 60;
				var days 		= hours / 24;
				var years 		= days / 365;
				var finalTime 	= (seconds < 45 && template('seconds', seconds) || seconds < 90 && template('minute', 1) || minutes < 45 && template('minutes', minutes) || minutes < 90 && template('hour', 1) || hours < 24 && template('hours', hours) || hours < 42 && template('day', 1) || days < 30 && template('days', days) || days < 45 && template('month', 1) || days < 365 && template('months', days / 30) || years < 1.5 && template('year', 1) || template('years', years));

				// Update
			    _t.text(finalTime);

			    // Do not refresh too old!
			    if(typeof timeAgoList[ID] !== 'undefined' && (days > 3 || years > 1))
			    	clearInterval(timeAgoList[ID]);

			},




		/**
		 *
		 *	@cookieUtil
		 *
		 *
		 **/
		cookieUtil: function(selector) {

			var el = jQuery(selector);
			
			if(el.length < 1)
				return;


			el.not('.js-sowcookiefied').addClass('js-sowcookiefied').on('click', function(e) {
				e.preventDefault();

				var _t 				= jQuery(this),
			    	_set 			= _t.data('cookie-set') 		|| '',
			    	_del 			= _t.data('cookie-del') 		|| '',
			    	_toggle 		= _t.data('cookie-toggle') 		|| '',
			    	_val 			= _t.data('cookie-val') 		|| '1',
			    	_expire 		= _t.data('cookie-expire') 		|| '7',
			    	_path 			= _t.data('cookie-path') 		|| '/', /* Safari Issue */ // $.SOW.globals.cookie_secure,
			    	toastMsgSet 	= _t.data('toast-msg-set') 		|| '',
			    	toastMsgDel 	= _t.data('toast-msg-del') 		|| '',
			    	toastMsgPos 	= _t.data('toast-msg-pos') 		|| 'top-center',
			    	toastTypeSet 	= _t.data('toast-msg-type-set') || 'success',
			    	toastTypeDel 	= _t.data('toast-msg-type-del') || 'success',
			    	toastMsg 		= '',
			    	toastType 		= '';


			    // SET
			    if(_set != '') {
			    	Cookies.set(_set, _val, { expires: _expire, path: _path });
			    	toastMsg 	= toastMsgSet;
			    	toastType 	= toastTypeSet;
			    }


			    // DEL
			    else if(_del != '') {
			    	Cookies.remove(_del, { path: _path });
			    	toastMsg 	= toastMsgDel;
			    	toastType 	= toastTypeDel;
			    }


			    // TOGGLE
			    else if(_toggle != '') {
			    	var chkCookie = Cookies.get(_toggle, { path: _path });

			    	if(!chkCookie) {
			    		Cookies.set(_toggle, _val, { expires: _expire, path: _path });
			    		toastMsg 	= toastMsgSet;
			    		toastType 	= toastTypeSet;
			    	} else {
				    	Cookies.remove(_toggle, { path: _path });
				    	toastMsg 	= toastMsgDel;
				    	toastType 	= toastTypeDel;
			    	}
			    }


			    // TOAST MESSAGE
			    if(toastMsg != '' && typeof $.SOW.core.toast === 'object') {
			    	$.SOW.core.toast.destroy();
					$.SOW.core.toast.show(toastType, '', toastMsg, toastMsgPos, 1500, true);
			    }


			});

		},





		/**
		 *
		 *	@slideshow
		 *
		 *
		 **/
		slideshow: function(selector) {

			var el 		= jQuery(selector),
				loaded 	= false;
			
			if(el.length < 1)
				return;

			el.each(function() {

				var _t 				= jQuery(this),
					dataBgs 		= _t.data('sow-slideshow') 				|| '',
					dataBgsXs		= _t.data('sow-slideshow-xs') 			|| '',
					dataInterval 	= _t.data('sow-slideshow-interval') 	|| 4000,
					dataFadeDelay 	= _t.data('sow-slideshow-fade-delay') 	|| 1500,
					slideRand 		= 'sow_'+$.SOW.helper.randomStr(3, 'L');


				// Is Mobile!
				if($.SOW.globals.is_mobile === true && dataBgsXs.length > 10)
					dataBgs = dataBgsXs;

				// should be a long string
				if(dataBgs.length < 10)
					return false;

				// remove attribute, already got!
				_t.removeAttr('data-sow-slideshow');

				// create a container, just to izolate stuff!
				_t.prepend('<div id="'+slideRand+'" class="sow-slideshow absolute-full z-index-0"></div>');
				
				// Split by comma
				var arrImgs = dataBgs.split(',');

				// Create array! Avoid checking the DOM each time!
				slideshowList[slideRand] 			= {};
				slideshowList[slideRand].current 	= 0;
				slideshowList[slideRand].itemsCount = 0;
				slideshowList[slideRand].timeOutInstance;

				// Create each item and push it to the container
				for(var i = 0; i < arrImgs.length; i++) {
					var _class_ 	= (i === 0) ? 'sow-slideshow-current' : '';
					var _display_ 	= (i === 0) ? '' : 'display:none;';


					var imgInstance 		= new Image();
						imgInstance.src 	= arrImgs[i];
						imgInstance.onload 	= function(e) {/* on load - nothing */}
						imgInstance.onerror = function(e) {/* on error - nothing */}

						jQuery('#'+slideRand).prepend('<span class="sow-slideshow-item sow-slideshow-item-'+i+' absolute-full bg-cover ' + _class_ + '" style="z-index:0;'+_display_+'background-image:url(' + imgInstance.src + ')"></span>');
						slideshowList[slideRand].itemsCount++;
				}

				// no images - no loop needed!
				// first image is already visible!
				if(arrImgs.length < 2)
					return false;


				// Looper start!
				slideLooper();
				function slideLooper() {
					slideshowList[slideRand].timeOutInstance = setTimeout(function () {

						// determine next image
						var next = slideshowList[slideRand].current + 1;
						if(next >= slideshowList[slideRand].itemsCount)
							next = 0;

						jQuery('#'+slideRand+' span.sow-slideshow-item-'+slideshowList[slideRand].current).fadeOut(dataFadeDelay);
						jQuery('#'+slideRand+' span.sow-slideshow-item-'+next).fadeIn(dataFadeDelay);
						slideshowList[slideRand].current = next;

						slideLooper();

					}, dataInterval);
				}



				// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
				// Pause on tab out of focus!
				function onVisibilityChanged() {

					if (document.hidden || document.mozHidden || document.webkitHidden || document.msHidden) {
						// The tab has lost focus
						clearTimeout(slideshowList[slideRand].timeOutInstance);
					} else {
						// The tab has gained focus
						slideshowList[slideRand].timeOutInstance = setTimeout(slideLooper, dataInterval);
					}

				}

				document.addEventListener("visibilitychange", onVisibilityChanged, false);
				document.addEventListener("mozvisibilitychange", onVisibilityChanged, false);
				document.addEventListener("webkitvisibilitychange", onVisibilityChanged, false);
				document.addEventListener("msvisibilitychange", onVisibilityChanged, false);
				// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --


				loaded = true;

			});



			// -- * --
			if(loaded === true)
				$.SOW.helper.consoleLog('Init : ' + scriptInfo + ' : Slideshow');
			// -- * --

		},




		/**
		 *
		 *	@cloner
		 *
		 *
		 **/
		cloner: function(selector) {

			var el 		= jQuery(selector);
			
			if(el.length < 1)
				return;

			el.not('.js-sowclonified').addClass('js-sowclonified').on('click', function(e) {
				e.preventDefault();

				var _t 				= jQuery(this),
					_target 		= _t.data('clone-target') 			|| '',
					_destination	= _t.data('clone-destination') 		|| '',
					_cloneLimit		= _t.data('clone-limit') 			|| 0,
					_cloneMethod	= _t.data('clone-method') 			|| 'append',	// append|prepend
					_initSortable	= _t.attr('data-clone-sortable') 	|| 'false';

				if(_target == '' || _destination == '')
					return null;


				// clone and add required classes to work with
				var clone = jQuery(_target).clone();
					clone.addClass('js-cloned js-cloned-fresh');


				// limit cloned elements
				if(Number(_cloneLimit) > 0) {
					if(jQuery('.js-cloned', _destination).length >= Number(_cloneLimit)) {
						_t.addClass('disabled').prop('disabled', true);
						return false;
					}
				}


				// append clone
				if(_cloneMethod == 'prepend')
					jQuery(_destination).prepend(clone);
				else
					jQuery(_destination).append(clone);


				// Clean inputs of clones
				jQuery('.js-cloned-fresh input[type=text], .js-cloned-fresh input[type=email], .js-cloned-fresh input[type=number], .js-cloned-fresh textarea', _destination).val(''); // empty


				// replace classes, where is required
				jQuery('.js-cloned-fresh [data-cloned-replace-class]', _destination).each(function() {
					var __t = jQuery(this);
						__t.removeAttr('class').attr('class', __t.data('cloned-replace-class'));
				});


				// bind remove button to clone
				jQuery('.js-cloned-fresh '+selector+', .js-cloned-fresh .btn-clone-remove').removeClass('sow-util-cloner').on('click', function(e) {
					e.preventDefault();
					jQuery(this).parents('.js-cloned').remove();
					_t.removeClass('disabled').prop('disabled', false);
				});


				// remove identifier classes - job done!
				jQuery('.js-cloned-fresh', _destination).removeClass('js-cloned-fresh');


				// init sortable
				if(_initSortable+'' == 'true') {

					if(typeof $.SOW.vendor.sortable === 'object')
						$.SOW.vendor.sortable.init(_destination, null);

				}

				// Reinits
				$.SOW.reinit(_destination);

			});




			/**

				Preadded clones : remove button
				(on load)

			**/
			jQuery('.js-cloned').not('.js-clonedbounded').addClass('js-clonedbounded').each(function() {

				var _href = jQuery('a[data-clone-target]', jQuery(this));

				_href.on('click', function(e) {

					var _target = jQuery(this).data('clone-target') || '';
					if(_target == '') return;

					e.preventDefault();
					jQuery(this).parents('.js-cloned').remove();
					jQuery('a.sow-util-cloner', _target).removeClass('disabled').prop('disabled', false);

				});

			});

		},





		/**
		 *
		 *	@UtilAction
		 *
		 *
		 **/
		UtilAction: function(selector) {

			var el 		= jQuery(selector);
			
			if(el.length < 1)
				return;

			if(el.hasClass('js-sowutilified'))
				return;

			el.not('.js-sowutilified').addClass('js-sowutilified').on('click', function(e) {

				var _t 						= jQuery(this),
					
					// 'true' = do not toggle 'active'class
					_targetSelfIgnore		= _t.attr('data-util-self-ignore') 				|| 'false',

					_targetHide				= _t.data('util-target-hide') 					|| '',
					_targetShow				= _t.data('util-target-show') 					|| '',

					_targetClassAdd			= _t.data('util-target-class-add') 				|| '',
					_targetClassAddVal		= _t.data('util-target-class-add-val')			|| '',

					_targetClassDel			= _t.data('util-target-class-remove') 			|| '',
					_targetClassDelVal		= _t.data('util-target-class-remove-val')		|| '',

					_targetClassToggle		= _t.data('util-target-class-toggle') 			|| '',
					_targetClassToggleVal	= _t.data('util-target-class-toggle-val')		|| '',

					_targetInput			= _t.data('util-target-input') 					|| '',
					_targetInpuVal			= _t.data('util-target-input-val') 				|| '',

					_targetPlaceholder		= _t.data('util-target-placeholder') 			|| '',
					_targetPlaceholderVal	= _t.data('util-target-placeholder-val') 		|| '',

					_targetReadonlyOn		= _t.data('util-target-readonly-on') 			|| '',
					_targetReadonlyOff		= _t.data('util-target-readonly-off') 			|| '',
					_targetReadonlyToggle	= _t.data('util-target-readonly-toggle')		|| '',
					
					_targetDisableOn		= _t.data('util-target-disable-on') 			|| '',
					_targetDisableOff		= _t.data('util-target-disable-off') 			|| '',
					_targetDisableToggle	= _t.data('util-target-disable-toggle')			|| '',

					_targetRemove			= _t.data('util-target-remove') 				|| '',

					_targetFocus			= _t.data('util-target-focus') 					|| '',

					// general toast, different than ajax
					_toastMsg				= _t.data('util-toast-msg') 					|| '',
					_toastPosition			= _t.data('util-toast-position') 				|| 'top-center',
					_toastType				= _t.data('util-toast-type') 					|| 'success',
					_toastTiming			= _t.data('util-toast-timeout') 				|| 2500,

					// Ajax
					_targetAjaxRequest		= _t.data('util-ajax-request')					|| '',
					_targetAjaxMethod		= _t.data('util-ajax-method')					|| $.SOW.core.utils.config.method,
					_targetAjaxParams		= _t.data('util-ajax-params')					|| '',
					_toastAjaxSuccessMsg	= _t.data('util-ajax-toast-success') 			|| 'Sucessfully Updated!',
					_toastAjaxPosition		= _t.data('util-ajax-toast-position') 			|| 'top-center',
					_toastAjaxTiming		= _t.data('util-ajax-toast-timeout') 			|| 2500;


				// Links only!
				if(_t.attr('href'))
					e.preventDefault();

				// Label : because fire twice
				// Is a DOM `issue` - the way it works
				if('label', _t) {
					e.preventDefault();

					if(jQuery('input', _t).is(':checked')) {
						jQuery('input', _t).removeAttr('checked');
					} else {
						jQuery('input', _t).attr('checked', true);
					}

				}


				if(_targetSelfIgnore+'' != 'true')
					_t.toggleClass('active');


				// hide
				if(_targetHide != '')
					jQuery(_targetHide).addClass('hide hide-force');

				// show
				if(_targetShow != '')
					jQuery(_targetShow).removeClass('hide hide-force');

				// value
				if(_targetInput != '')
					jQuery(_targetInput).val(_targetInpuVal);

				// placeholder
				if(_targetPlaceholder != '')
					jQuery(_targetPlaceholder).val(_targetPlaceholderVal);

				// class add
				if(_targetClassAdd != '')
					jQuery(_targetClassAdd).addClass(_targetClassAddVal);

				// class remove
				if(_targetClassDel != '')
					jQuery(_targetClassDel).addClass(_targetClassDelVal);

				// class toggle
				if(_targetClassToggle != '')
					jQuery(_targetClassToggle).toggleClass(_targetClassToggleVal);

				// remove element
				if(_targetRemove != '')
					jQuery(_targetRemove).remove();



				// readonly:on
				if(_targetReadonlyOn != '')
					jQuery(_targetReadonlyOn).addClass('readonly').attr('readonly', true).prop('readonly', true);

				// readonly:off
				if(_targetReadonlyOff != '')
					jQuery(_targetReadonlyOff).removeClass('readonly').removeAttr('readonly').prop('readonly', false);

				// readonly:toggle
				if(_targetReadonlyToggle != '') {
					if(jQuery(_targetReadonlyToggle).attr('readonly')) {
						jQuery(_targetReadonlyToggle).removeClass('readonly').removeAttr('readonly').prop('readonly', false);
					} else {
						jQuery(_targetReadonlyToggle).removeClass('readonly').removeAttr('readonly').prop('readonly', false);
					}
				}


				// disable:on
				if(_targetDisableOn != '')
					jQuery(_targetDisableOn).addClass('disabled').attr('disabled', true).prop('disabled', true);

				// disable:off
				if(_targetDisableOff != '')
					jQuery(_targetDisableOff).removeClass('disabled').removeAttr('disabled').prop('disabled', false);

				// disable:toggle
				if(_targetDisableToggle != '') {
					if(jQuery(_targetDisableToggle).attr('disabled')) {
						jQuery(_targetDisableToggle).removeClass('disabled').removeAttr('disabled').prop('disabled', false);
					} else {
						jQuery(_targetDisableToggle).removeClass('disabled').removeAttr('disabled').prop('disabled', false);
					}
				}


				// focus
				if(_targetFocus != '') {

					setTimeout(function() {

						jQuery(_targetFocus).focus();
						
					}, 400);

				}


				// Toast message
				if(_targetAjaxRequest == '' && _toastMsg != '') {

					if(typeof $.SOW.core.toast === 'object')
						$.SOW.core.toast.show(_toastType, '', _toastMsg, _toastPosition, Number(_toastTiming), true);

				}




				// AJAX REQUEST
				if(_targetAjaxRequest != '') {

					var data_params =  $.SOW.core.utils.config.data_params;
					if(_targetAjaxParams != '') {

						var ajax_params_arr = $.SOW.helper.params_parse(_targetAjaxParams);
						for (var i = 0; i < ajax_params_arr.length; ++i) {
							data_params[ajax_params_arr[i][0]] = ajax_params_arr[i][1];
						}

					}

					// Ajax Request
					jQuery.ajax({
						url:			_targetAjaxRequest,
						type: 			_targetAjaxMethod,
						data: 			data_params,
						contentType: 	$.SOW.core.utils.config.contentType,
						dataType: 		$.SOW.core.utils.config.dataType,
						headers: 		$.SOW.core.utils.config.headers,
						crossDomain: 	$.SOW.core.utils.config.crossDomain,

						beforeSend: function() {

							$.SOW.helper.consoleLog('SOW Util : [Ajax][Request Sent]: ' + _targetAjaxRequest);

						},

						error: 	function(XMLHttpRequest, textStatus, errorThrown) {

							if(typeof $.SOW.core.toast === 'object') {
								$.SOW.core.toast.show('danger', '404 Error', 'Unexpected Internal error!', 'bottom-center', 0, true);
							} else {
								alert("[404] Unexpected internal error!");
							}

							// if debug enabled, see config
							if($.SOW.config.sow__debug_enable === true) {
								$.SOW.helper.consoleLog('----------------------------');
								$.SOW.helper.consoleLog('--- AJAX REQUEST ERROR ----');
								$.SOW.helper.consoleLog(' - MODAL -');
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

							$.SOW.helper.consoleLog('SOW Util : [Ajax][Server Response]: ' + data);

							if(_toastAjaxSuccessMsg != '' && typeof $.SOW.core.toast === 'object')
								$.SOW.core.toast.show('success', '', _toastAjaxSuccessMsg, _toastAjaxPosition, Number(_toastAjaxTiming), true);

						}

					});

				}

			});

		}

	};


})(jQuery);