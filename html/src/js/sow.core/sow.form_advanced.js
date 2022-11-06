/**
 *
 *	[SOW] Form Advanced
 *
 *	@author 		Dorin Grigoras
 *					www.stepofweb.com
 *
 *	@Dependency 	-
 *	@Usage			$.SOW.core.form_advanced.init();
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
	var scriptInfo 				= 'SOW Form Advanced';


	$.SOW.core.form_advanced = {


		/**
		 *
		 *	@config
		 *
		 *
		 **/
		config: {

			/* 

				1. Bulk
				@form_advanced_bulk

			*/
			selector_advanced_bulk: 			"a.js-form-advanced-bulk",
			advanced_bulk_selected_require: 	false,

				// toast messages
				toast_pos: 							'bottom-center',
				toast_delay: 						2000,
				toast_msg_noitems: 					'No Items Selected!',



			/* 

				2. Form input numeric limit
				@form_advanced_numeric_limit

			*/
			selector_advanced_numeric_limit: 		"input.js-form-advanced-limit",




			/* 

				3. Form char count
				@form_advanced_char_count_down

			*/
			selector_advanced_char_count_down: 		"input.js-form-advanced-char-count-down, textarea.js-form-advanced-char-count-down",
			selector_advanced_char_count_up: 		"input.js-form-advanced-char-count-up, textarea.js-form-advanced-char-count-up",
			selector_advanced_type_toggle: 			".btn-password-type-toggle",

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
			this.config 			= (__config !== null) ? $.extend({}, this.config, __config) : this.config;


			// 1. Bulk
			$.SOW.core.form_advanced.form_advanced_bulk(this.config.selector_advanced_bulk);
			
			// 2. Form input numeric limit
			$.SOW.core.form_advanced.form_advanced_numeric_limit(this.config.selector_advanced_numeric_limit);

			// 3. Form char count down
			$.SOW.core.form_advanced.form_advanced_char_count_down(this.config.selector_advanced_char_count_down);

			// 4. Form char count up
			$.SOW.core.form_advanced.form_advanced_char_count_up(this.config.selector_advanced_char_count_up);
			
			// 5. Form password toggle
			$.SOW.core.form_advanced.form_advanced_type_toggle(this.config.selector_advanced_type_toggle);

			// 6. Misc
			$.SOW.core.form_advanced.formatCreditCard();
			$.SOW.core.form_advanced.formAdvancedList();
			$.SOW.core.form_advanced.formAdvancedReset();


			// No chaining
			return null;

		},



		/**
		 *
		 *	@form_advanced_bulk
		 	Form actions[submit] using a regular link
		 *
		 * 	
		 *
		 **/
		form_advanced_bulk: function(_this) {

			// -- * --
			if(jQuery(_this).length > 0)
				$.SOW.helper.consoleLog('Init : ' + scriptInfo);
			// -- * --


			jQuery(_this).not('.js-form-advancified').addClass('js-form-advancified').on('click', function(e) {
				e.preventDefault();

				var _t 							= jQuery(this),
					
					_citems						= _t.data('js-form-advanced-bulk-container-items') 						|| 'table tbody',		// from what container to count checked items?
					_reqSelectedItems 			= _t.data('js-form-advanced-bulk-required-selected')					|| $.SOW.core.form_advanced.config.advanced_bulk_selected_require,
					_requiredMsg 				= _t.data('js-form-advanced-bulk-required-txt-error') 					|| $.SOW.core.form_advanced.config.toast_msg_noitems,
					_requiredMsgPos 			= _t.data('js-form-advanced-bulk-required-txt-position') 				|| $.SOW.core.form_advanced.config.toast_pos,		// button icon

					// Modal
					_reqModalCustom 			= _t.data('js-form-advanced-bulk-required-custom-modal') 				|| '', // modal id
					_reqModalCustomAjaxUrl		= _t.data('js-form-advanced-bulk-required-custom-modal-content-ajax')	|| '',

					_reqModalType 				= _t.data('js-form-advanced-bulk-required-modal-type')					|| 'secondary',
					_reqModalSize 				= _t.data('js-form-advanced-bulk-required-modal-size')					|| 'modal-md',
					_reqModalTitle 				= _t.data('js-form-advanced-bulk-required-modal-txt-title')				|| 'Please Confirm',
					_reqModalTxtSubtitle 		= _t.data('js-form-advanced-bulk-required-modal-txt-subtitle')			|| '-',
					_reqModalTxtBodyTxt			= _t.data('js-form-advanced-bulk-required-modal-txt-body-txt')			|| 'Are you sure?',
					_reqModalTxtBodyInfo		= _t.data('js-form-advanced-bulk-required-modal-txt-body-info')			|| '',
					_reqModalBtnTxtYes 			= _t.data('js-form-advanced-bulk-required-modal-btn-text-yes')			|| 'Submit', 
					_reqModalBtnTxtNo 			= _t.data('js-form-advanced-bulk-required-modal-btn-text-no')			|| 'Cancel',
					_reqModalBtnIcoYes 			= _t.data('js-form-advanced-bulk-required-modal-btn-icon-yes') 			|| $.SOW.config.sow__icon_check,		// button icon
					_reqModalBtnIcoNo 			= _t.data('js-form-advanced-bulk-required-modal-btn-icon-no') 			|| $.SOW.config.sow__icon_close,		// button icon

					// Form
					_formID 					= _t.attr('data-js-form-advanced-form-id')								|| '', // form#id .attr REQUIRED, or old one used!
					_formSubmitNoConfirm 		= _t.data('js-form-advanced-bulk-submit-without-confirmation')			|| 'false',

					// Hidden action input
					_formActionID				= _t.data('js-form-advanced-bulk-hidden-action-id')						|| '#action',
					_formActionVal				= _t.data('js-form-advanced-bulk-hidden-action-value')					|| '';

				// count selecteditems & update
				var total_selected_items = jQuery(_citems + " input:checked").length;



				// Check for required selected items
				if(_reqSelectedItems == true && Number(total_selected_items) < 1) {

					// SHOW ERROR
					if(typeof $.SOW.core.toast === 'object') {
						$.SOW.core.toast.destroy();
						$.SOW.core.toast.show('danger', '', _requiredMsg, _requiredMsgPos, $.SOW.core.form_advanced.config.toast_delay, true);
					} else {
						alert(_requiredMsg);
					}

					e.stopPropagation();
					return;

				}






				// Update action hidden input
				if(_formActionVal != '')
					jQuery(_formActionID).val(_formActionVal);


				// Direct submit, no confirmation
				if(_formSubmitNoConfirm != 'false') {
					jQuery(_formID).unbind().submit(); // unbind required
					return;
				}


				// Button Icons
				if(_reqModalBtnIcoYes.length > 1)
					var _reqModalBtnTxtYes = '<i class="' + _reqModalBtnIcoYes + '"></i> ' + _reqModalBtnTxtYes;

				if(_reqModalBtnIcoNo.length > 1)
					var _reqModalBtnTxtNo = '<i class="' + _reqModalBtnIcoNo + '"></i> ' + _reqModalBtnTxtNo;


				// Replacements
				_reqModalTitle 			= _reqModalTitle.replace('{{no_selected}}', total_selected_items);
				_reqModalTxtBodyTxt 	= _reqModalTxtBodyTxt.replace('{{no_selected}}', total_selected_items);
				_reqModalTxtBodyInfo 	= _reqModalTxtBodyInfo.replace('{{no_selected}}', total_selected_items);
				_reqModalTxtSubtitle 	= _reqModalTxtSubtitle.replace('{{no_selected}}', total_selected_items);


				// Additional info
				var _reqModalTxtBodyTxt = (_reqModalTxtBodyInfo != '') ? _reqModalTxtBodyTxt + '<span class="d-block d-block fs--12 mt--3">' + _reqModalTxtBodyInfo + '</span>' : _reqModalTxtBodyTxt;








				// 1. Inline Modal
				if(_reqModalCustom != '') {

					// Update selected items counter
					if(_reqModalCustom != '')
						$.SOW.core.form_advanced.form_advanced_bulk_counter_update(total_selected_items);


					// SHOW MODAL
					jQuery(_reqModalCustom).modal('show');


					// LOAD FROM AJAX
					if(_reqModalCustomAjaxUrl != '') {
						
						jQuery(_reqModalCustom).find('.modal-content').load(_reqModalCustomAjaxUrl, function() {

							// Update selected items counter
							$.SOW.core.form_advanced.form_advanced_bulk_counter_update(total_selected_items);

						});

					}

					// stop here
					return;

				
				} 




				// 2. Generated modal
				var _tpl = '<div class="modal fade" id="js_advanced_form_bulk_modal_confirm" role="dialog" tabindex="-1" aria-labelledby="modal-title-confirm" aria-hidden="true">'
					+ '<div class="modal-dialog '+_reqModalSize+'" role="document">'

						+ '<div class="modal-content">'

							+ '<div class="modal-header b-0 bg-'+_reqModalType+'-soft">'
								
								+ '<h5 id="modal-title-confirm" class="modal-title font-light fs--18 line-height-1">'
									+ _reqModalTitle
									+ '<small class="d-block fs--12 mt--3">'+_reqModalTxtSubtitle+'</small>'
								+ '</h5>'

								+ '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
									+ '<span class="'+$.SOW.config.sow__icon_close+' fs--18" aria-hidden="true"></span>'
								+ '</button>'

							+ '</div>'

							+ '<div class="modal-body fs--18 pt--30 pb--30">'

									+ _reqModalTxtBodyTxt

							+ '</div>'

							+ '<div class="modal-footer">'

								+ '<button type="submit" class="btn pt--10 pb--10 fs--16 btn-js-advanced-form-bulk-confirm-yes btn-'+ _reqModalType +'">'
									+ _reqModalBtnTxtYes
								+ '</button>'

								+ '<a href="#" class="btn pt--10 pb--10 fs--16 btn-js-advanced-form-bulk-confirm-no btn-light" data-dismiss="modal">'
									+ _reqModalBtnTxtNo
								+ '</a>'

							+ '</div>'

						+ '</div>'

					+ '</div>'
				+ '</div>';

				// Add modal to DOM

				$('#js_advanced_form_bulk_modal_confirm').remove();
				$(_formID).append(_tpl); // REQUIRED INSIDE THE FORM! Because of Submit button!

				// Show Modal
				$('#js_advanced_form_bulk_modal_confirm').modal('handleUpdate').modal('show');

				// Custom Ajax Content
				if(_reqModalCustomAjaxUrl != '') {
					
					jQuery('#js_advanced_form_bulk_modal_confirm .modal-body').empty().append('<div class="py-4 text-center animate-bouncein"><i class="'+$.SOW.config.sow__icon_loading+' fs--40 text-muted"></i></div>');

					jQuery('#js_advanced_form_bulk_modal_confirm .modal-body').load(_reqModalCustomAjaxUrl, function() {

						// Update selected items counter
						$.SOW.core.form_advanced.form_advanced_bulk_counter_update(total_selected_items);

					});
				}

				return;


			});


		},




		/**
		 *
		 *	@form_advanced_bulk_counter_update
		 *	:: Helper
		 * 	
		 *
		 **/
		form_advanced_bulk_counter_update: function(total_selected_items) {

			// Update selected items
			jQuery('.js-form-advanced-selected-items').html(total_selected_items);

		},


		/**
		 *
		 *	@form_advanced_numeric_limit
		 	Input min/max limits

				<!-- input limit + hidden message -->
				<div class="position-relative">

					<span class="js-form-advanced-limit-info badge badge-warning hide animate-bouncein position-absolute absolute-top m--2">
						please, order between 1 and 48.
					</span>

					<input type="number" value="8" min="1" max="48" class="form-control js-form-advanced-limit">
				</div>
				<!-- /input limit + hidden message -->

		 *
		 * 	
		 *
		 **/
		form_advanced_numeric_limit: function(_this) {

			if(jQuery(_this).length < 1)
				return;

			jQuery(_this).keyup(function() {
				var _t 		= jQuery(this),
					_val 	= _t.val() 		 || '',
					_min 	= _t.attr('min') || '',
					_max 	= _t.attr('max') || '';

				if(_min == '' || _max == '') 
					return;

				if(Number(_val) < Number(_min))
					_t.val(_min);

				else if(Number(_val) > Number(_max)) {
					_t.val(_max);

					// Optional simple info message
					$.SOW.core.form_advanced.form_advanced_simple_alert(_t);
				}


			});

		},



		/**
		 *
		 *	@form_advanced_char_count_down
		 	Char Count Down

			<!-- input -->
			<div class="position-relative">
				
				<span class="js-form-advanced-limit-info badge badge-warning hide animate-bouncein position-absolute absolute-top m--2">
					100 chars limit
				</span>

				<input type="text" name="-" class="form-control js-form-advanced-char-count-down" data-output-target=".js-form-advanced-char-left" value="" maxlength="100">
				
				<div class="fs--12 text-muted text-align--end mt--3">
					characters left: <span class="js-form-advanced-char-left">100</span>
				</div>
			
			</div>
			
			<br>

			<!-- textarea -->
			<div class="position-relative">
				
				<span class="js-form-advanced-limit-info badge badge-warning hide animate-bouncein position-absolute absolute-top m--2">
					100 chars limit
				</span>

				<textarea class="js-form-advanced-char-count-down form-control" data-output-target=".js-form-advanced-char-left2" maxlength="100"></textarea>
				
				<div class="fs--12 text-muted text-align--end mt--3">
					characters left: <span class="js-form-advanced-char-left2">100</span>
				</div>

			</div>

		 *
		 * 	
		 *
		 **/
		form_advanced_char_count_down: function(_this) {


			if(jQuery(_this).length < 1)
				return;

			jQuery(_this).keyup(function(e) {

				var _t 		= jQuery(this),
					_val 	= _t.val(),
					_length = _val.length,
					_max 	= _t.attr('maxlength') 		|| 0,
					_output = _t.data('output-target') 	|| '.char-left';

				if(_max < 1 && _output != '')
					return;

				if(_length >= _max) {
					_t.val(_val.substring(0, _max - 1)); // limit - remove anything over maximum allowed
					jQuery(_output).html('0');

					// Optional simple info message
					$.SOW.core.form_advanced.form_advanced_simple_alert(_t);

				} else {
					var _left = _max - _length;
					jQuery(_output).html(_left);
				}


			});

		},





		/**
		 *
		 *	@form_advanced_char_count_up
		 	Char Count Up


			Remove maxlength for no limit, only to count chars



			<!-- input -->
			<div class="position-relative">
				
				<span class="js-form-advanced-limit-info badge badge-warning hide animate-bouncein position-absolute absolute-top m--2">
					100 chars limit
				</span>

				<input type="text" name="-" class="form-control js-form-advanced-char-count-up" data-output-target=".js-form-advanced-char-total" value="" maxlength="100">
				
				<div class="fs--12 text-muted text-align--end mt--3">
					characters: <span class="js-form-advanced-char-total">0</span> / 100
				</div>

			</div>

			<br>

			<!-- textarea -->
			<div class="position-relative">
				
				<span class="js-form-advanced-limit-info badge badge-warning hide animate-bouncein position-absolute absolute-top m--2">
					100 chars limit
				</span>

				<textarea class="js-form-advanced-char-count-up form-control" data-output-target=".js-form-advanced-char-total2" maxlength="100"></textarea>
				
				<div class="fs--12 text-muted text-align--end mt--3">
					characters: <span class="js-form-advanced-char-total2">0</span> / 100
				</div>

			</div>

		 *
		 * 	
		 *
		 **/
		form_advanced_char_count_up: function(_this) {

			if(jQuery(_this).length < 1)
				return;

			jQuery(_this).keyup(function() {

				var _t 		= jQuery(this),
					_val 	= _t.val(),
					_length = _val.length 				|| 0,
					_max 	= _t.attr('maxlength') 		|| 0,
					_output = _t.data('output-target') 	|| '.char-count';

				jQuery(_output).html(_length);

				// limit if specified
				if(_length >= _max && _max > 0) {
					_t.val(_val.substring(0, _max)); // limit - remove anything over maximum allowed

					// Optional simple info message
					$.SOW.core.form_advanced.form_advanced_simple_alert(_t);
				}

			});

		},




		/**
		 *
		 *	@form_advanced_simple_alert
		 *	Optional form alert
		 * 	
		 *
		 **/
		form_advanced_simple_alert: function(_this) {

			_this.next('.js-form-advanced-limit-info').removeClass('hide');
			_this.prev('.js-form-advanced-limit-info').removeClass('hide');

			setTimeout(function() {
				_this.next('.js-form-advanced-limit-info').addClass('hide');
				_this.prev('.js-form-advanced-limit-info').addClass('hide');
			}, 3000);

		},




		/**
		 *
		 *	@form_advanced_type_toggle
		 * 	
		 *
		 **/
		form_advanced_type_toggle: function(_this) {

			if(jQuery(_this).length < 1)
				return;

			jQuery(_this).on('click', function(e) {
				e.preventDefault();

				var _target = jQuery(this).data('target') || '';

				if(_target == '')
					return;

				jQuery(this).toggleClass('active');
				if(jQuery(_target).attr('type') == 'password') {
					jQuery(_target).attr('type', 'text');
				} else {
					jQuery(_target).attr('type', 'password');
				}

			});

		},




		/**
		 *
		 *	@formAdvancedList
		 * 	on a list, reveal/expand selected (example: payment method - checkout)
		 *
		 **/
		formAdvancedList: function() {

			jQuery('.form-advanced-list').each(function() {

				var _t = jQuery(this);

				jQuery('.form-advanced-list-reveal', _t).on('change', function() {

					var __t 		= jQuery(this),
						__target 	= __t.data('form-advanced-target') || '';

					// hide all first
					jQuery('.form-advanced-list-reveal-item', _t).addClass('hide hide-force');

					// reveal selected
					if(__target != '')
						jQuery(__target).removeClass('hide hide-force');

				})

			});

		},





		/**
		 *
		 *	@formAdvancedReset
		 * 	reset form on button click
		 *
		 **/
		formAdvancedReset: function() {

			jQuery('.form-advanced-reset').not('.js-ignore').not('.js-advancified').addClass('js-advancified').each(function() {

				var _t 		= jQuery(this),
					_target = _t.data('target-reset');

				if(_target == '')
					return null;

				jQuery(_target+' input').on('change', function() {
					_t.removeClass('hide hide-force');
				});

				jQuery(_target+' textarea').on('change', function() {
					_t.removeClass('hide hide-force');
				});



				// reset button click
				_t.on('click', function(e) {
					e.preventDefault();

					jQuery(_target+' input').val('');
					jQuery(_target+' textarea').val('');
					jQuery(_target+' input[type=checkbox]').prop('checked', false);
					jQuery(_target+' input[type=radio]').prop('checked', false);

					// hide reset button
					if(!_t.hasClass('js-ignore'))
						_t.addClass('hide hide-force');

				});


			});




		},





		/**
		 *
		 *	@formatCreditCard
		 * 	
		 *
		 **/
		formatCreditCard: function() {


			/*

				Credit card number

			*/
			jQuery('input.cc-format.cc-number').keyup(function() {

				var _t 				= jQuery(this),
					val 			= _t.val() || '',
					targetCardType 	= _t.data('card-type') || '';

				// format
				var cc_formatted = $.SOW.core.form_advanced.formatCardNumber(val);
				_t.val(cc_formatted);

				// Credit card type
				if(targetCardType != '') {
					var cc_type = $.SOW.core.form_advanced.detectCardType(val);
					var cc_type = (cc_type) ? cc_type.name : '';
					jQuery(targetCardType).val(cc_type);
				}

			});


			/*

				Credit card expire

			*/
			jQuery('input.cc-format.cc-expire').keyup(function(e) {

				var _t 				= jQuery(this),
					val 			= _t.val() || '',
					code 			= e.keyCode,
					allowedKeys 	= [8];

				if(allowedKeys.indexOf(code) !== -1) {
					return;
				}

				e.target.value = e.target.value.replace(
					/^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
					).replace(
					/^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
					).replace(
					/^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
					).replace(
					/^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
					).replace(
					/^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
					).replace(
					/[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
					).replace(
					/\/\//g, '/' // Prevent entering more than 1 `/`
				);

			});

		},



		/**
		 *
		 *	@formatCardNumber
		 * 	https://www.peterbe.com/plog/cc-formatter
		 *
		 **/
		formatCardNumber: function(value) {

			var v 		= value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
			var matches = v.match(/\d{4,16}/g);
			var match 	= matches && matches[0] || '';
			var parts 	= [];
			
			for (var i=0, len=match.length; i<len; i+=4) {
				parts.push(match.substring(i, i+4));
			}

			if(parts.length) {
				return parts.join(' ');
			} else {
				return value;
			}

		},




		/**
		 *
		 *	@detectCardType
		 * 	
		 *
		 **/
		detectCardType: function(number) {

		    var card_types = [
		      {
		        name: 'amex',
		        pattern: /^3[47]/,
		        valid_length: [15]
		      }, {
		        // name: 'diners_club_carte_blanche',
		        name: 'diners',
		        pattern: /^30[0-5]/,
		        valid_length: [14]
		      }, {
		        // name: 'diners_club_international',
		        name: 'diners',
		        pattern: /^36/,
		        valid_length: [14]
		      }, {
		        name: 'jcb',
		        pattern: /^35(2[89]|[3-8][0-9])/,
		        valid_length: [16]
		      }, {
		        name: 'laser',
		        pattern: /^(6304|670[69]|6771)/,
		        valid_length: [16, 17, 18, 19]
		      }, {
		        // name: 'visa_electron',
		        name: 'visa',
		        pattern: /^(4026|417500|4508|4844|491(3|7))/,
		        valid_length: [16]
		      }, {
		        name: 'visa',
		        pattern: /^4/,
		        valid_length: [16]
		      }, {
		        name: 'mastercard',
		        pattern: /^5[1-5]/,
		        valid_length: [16]
		      }, {
		        name: 'maestro',
		        pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
		        valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
		      }, {
		        name: 'discover',
		        pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
		        valid_length: [16]
		      }
		    ];


			var _j, _len1, _ref1, card, card_type, options = {};
			var __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };


			if (options.accept == null) {
				options.accept = (function() {
				var _i, _len, _results;
					_results = [];

				for (_i = 0, _len = card_types.length; _i < _len; _i++) {
					card = card_types[_i];
					_results.push(card.name);
				}

				return _results;

				})();
			}

			var  _ref = options.accept;
			for (var _i = 0, _len = _ref.length; _i < _len; _i++) {
				card_type = _ref[_i];
				
				if (__indexOf.call((function() {
					var _j, _len1, _results = [];

					for (var _j = 0, _len1 = card_types.length; _j < _len1; _j++) {
						card = card_types[_j];
						_results.push(card.name);
					}

					return _results;

				})(), card_type) < 0) {

					// throw "Credit card type '" + card_type + "' is not supported";

				}
			}

			_ref1 = (function() {
				var _k, _len1, _ref1, _results = [];
				
				for (_k = 0, _len1 = card_types.length; _k < _len1; _k++) {
					card = card_types[_k];
					if (_ref1 = card.name, __indexOf.call(options.accept, _ref1) >= 0) {
						_results.push(card);
					}
				}

				return _results;

			})();

			for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
				card_type = _ref1[_j];

				if (number.match(card_type.pattern)) {
					return card_type;
				}

			}

			return null;


			/**
		    var re = {
		        electron: 		/^(4026|417500|4405|4508|4844|4913|4917)\d+$/,
		        maestro: 		/^(5018|5020|5038|5612|5893|6304|6759|6761|6762|6763|0604|6390)\d+$/,
		        dankort: 		/^(5019)\d+$/,
		        interpayment: 	/^(636)\d+$/,
		        unionpay: 		/^(62|88)\d+$/,
		        visa: 			/^4[0-9]{12}(?:[0-9]{3})?$/,
		        mastercard: 	/^5[1-5][0-9]{14}$/,
		        amex: 			/^3[47][0-9]{13}$/,
		        diners: 		/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
		        discover: 		/^6(?:011|5[0-9]{2})[0-9]{12}$/,
		        jcb: 			/^(?:2131|1800|35\d{3})\d{11}$/
		    };

		    for(var key in re) {
		        if(re[key].test(number)) {
		            return key;
		        }
		    }
		    **/

		}

	}

})(jQuery);