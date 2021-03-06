(function(jQuery){

	jQuery.placeHolder = function(node, opts) {

		if(this == jQuery) return new jQuery.placeHolder(node, opts);
				
		/*------------------------------------------------------------------*/

		var opts = $.extend({}, jQuery.placeHolder.defaultOptions, $.isPlainObject(opts) ? opts : {text: opts});
		var $this = this;
		
		var textNode = $(node);
		
		var placeholderNode = $('<span />').
			addClass('zplaceholder-text').
			css({'position': 'absolute'}).
			insertBefore(textNode).
			hide();


		if(textNode.attr('id')) placeholderNode.attr('id', 'placeholder_for_' + textNode.attr('id'));
		
		var placeholderContentNode = $('<span />').
			addClass('zplaceholder-text-content').
			appendTo(placeholderNode);
		
		var valueCallback = null;
		var testCallback = null;
		var placeholderClassname = null;
		var clearOnFocus = false;
		
		var textLastValue = textNode.val();
		var forceFromFocusChange = false;
		
		var emptyValue = true;
		var hasFocus = false;
		
		
		
		/*------------------------------------------------------------------*/
		
		$this.setText = function(text) {
			placeholderContentNode.html(text);
			return $this;
		};
		
		$this.setValueCallback = function(callback) {
			valueCallback = callback;
			return $this;
		};
		
		$this.setTestCallback = function(callback) {
			testCallback = callback;
			return $this;
		};
		
		$this.setClearOnFocus = function(value) {
			clearOnFocus = value;
			return $this;
		};
		
		$this.setClassname = function(classname) {
			
			if(placeholderClassname != null) {
				placeholderNode.removeClass(placeholderClassname);
			}
			
			placeholderNode.addClass(placeholderClassname);
			
			return $this;
			
		};
		
		
		$this.triggerTest = function() {
			textNode.trigger('change');			
		};
		
		
		$this.setOptions = function(options) {
			
			options = $.extend({}, $.isPlainObject(options) ? options : {title: options});
			
			if(options['text'] != null) $this.setText(options['text']);
			if(options['valueCallback'] != null) $this.setValueCallback(options['valueCallback']);
			if(options['testCallback'] != null) $this.setTestCallback(options['testCallback']);
			if(options['classname'] != null) $this.setEmptyCallback(options['classname']);
			if(options['clearOnFocus'] != null) $this.setClearOnFocus(options['clearOnFocus']);
			
			return $this;
		};
		
		
		/*------------------------------------------------------------------*/
		
		textNode.bind('focus', function() {
			
			textNode.removeClass('placeholder');
			textNode.css('color', '');
			forceFromFocusChange = true;
			hasFocus = true;
			
			if(emptyValue) textNode.val('');
			
			if(clearOnFocus) placeholderNode.css('display', 'none');	
			
		});
		
		textNode.bind('blur', function(evt) {
			hasFocus = false;
		});
		
		
		textNode.bind('keyup keydown keypress', function() {
			if(textNode.val() != '') placeholderNode.css('display', 'none');	
		});
		
		
		textNode.bind('blur change', function(evt) {
			
			var textValue = textNode.val();
						
			if(!hasFocus && (forceFromFocusChange || textLastValue == null || textValue != textLastValue || textValue == '')) {

				var value = valueCallback.call(textNode, textValue);
				
				if(testCallback.call(textNode, value)) {
					
					textNode.removeClass('placeholder');
					textNode.css('color', '');
					placeholderNode.css('display', 'none');
					emptyValue = false;
					
				} else {
					
					textNode.addClass('placeholder');
					textNode.css('color', textNode.css('background-color'));
					placeholderNode.css('display', 'inline');
					emptyValue = true;
				}

				textLastValue = textValue;
				
				if(evt.type == 'blur') {
					forceFromFocusChange = false;
				}
				
			}
			
			
		});
		
		
		placeholderContentNode.bind('mousedown click mouseup', function() {
			textNode.focus();
		});
		
		/*------------------------------------------------------------------*/
		
		$this.setOptions(opts);
		
		emptyValue = !testCallback.call(textNode, valueCallback.call(textNode, textNode.val()));
		
		$this.triggerTest();

		$(document).ready(function() {

			placeholderNode.css('font-weight', textNode.css('font-weight'));
			placeholderNode.css('padding-top', textNode.css('padding-top'));
			placeholderNode.css('padding-bottom', textNode.css('padding-bottom'));
			placeholderNode.css('padding-left', textNode.css('padding-left'));
			placeholderNode.css('padding-right', textNode.css('padding-right'));
			placeholderNode.css('margin-top', textNode.css('border-top-width'));
			placeholderNode.css('text-align', textNode.css('text-align'));
			placeholderNode.css('width', textNode.css('width'));
			placeholderNode.css('margin-left', textNode.css('border-left-width'));
			placeholderNode.css('text-indent', parseInt(textNode.css('text-indent')));
			placeholderNode.css('z-index', textNode.getZIndex() + 2000);
			
			if(textNode.tagname() != 'TEXTAREA') {
				placeholderNode.css('line-height', String(parseInt(textNode.height())) + 'px');
			}
		});		
		
		/*------------------------------------------------------------------*/
		
		return $this;
	};
	
	
	
	jQuery.placeHolder.defaultOptions = {
		text: '',
		valueCallback: function(text) { return text; },
		testCallback: function(value) { return value && String(value).trim() != ''; },
		clearOnFocus: true
	};
	
	
	jQuery.fn.placeHolder = function(opts){

		$(this).each(function() {

			var obj = $(this).data('__placeHolder__');

			if(!obj) {
				
				obj = new jQuery.placeHolder(this, opts);
				$(this).data('__placeHolder__', obj);
								
			} else {
				
				obj.setOptions(opts);
				
			}
			
		});
		
		return $(this);
	};
	
	
	jQuery.fn.getPlaceHolder = function(opts){

		$(this).each(function() {

			var obj = $(this).data('__placeHolder__');

			if(!obj) {
				
				obj = new jQuery.placeHolder(this, opts);
				$(this).data('__placeHolder__', obj);
								
			} else {
				
				obj.setOptions(opts);
				
			}
			
		});
		
		return $(this).data('__placeHolder__');
	};

	
})(jQuery);	
