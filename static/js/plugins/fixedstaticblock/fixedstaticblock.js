(function(jQuery){
	
	jQuery.fixedStaticBlock = function(node, opts) {
		
		if(this == jQuery) return new jQuery.fixedStaticBlock(node, opts);
				
		/*------------------------------------------------------------------*/

		var opts = $.extend({}, jQuery.fixedStaticBlock.defaultOptions, $.isPlainObject(opts) ? opts : (opts != null ? (typeof opts == 'string' ? {'position': opts} : {}) : {}));
		var $this = this;
		
		var contentIsNode;
		var contentNode; 
		var isVisible = false;
		var closeTimeout = null;
		var contentNodePos = {'left': null, 'top': null, 'right': null, 'bottom': null};
		
		if($.isNode(node)) {
			contentNode = $(node).remove().prependTo(document.body);
			contentIsNode = true;
		} else {
			contentNode = $('<div />').html(node == null ? '' : node).appendTo(document.body);
			contentIsNode = false;
 		}

		contentNode.hide().css({'position': 'absolute', 'z-index': jQuery.fixedStaticBlock.zIndex});
		contentNode.data('__fixedStaticBlock__', $this);
		contentNode.addClass(jQuery.fixedStaticBlock.blockClassname);
		contentNode.wrapInner($('<div />').addClass(jQuery.fixedStaticBlock.contentBlockClassname));
		
		/*------------------------------------------------------------------*/
		
		var _parsePositionValue = function(value, avalSize) {
		
			if(typeof value != 'number') {

				value = String(value).replace(/\s/g, '').toLowerCase();

				if(value == '')	value = 0;

				else {

					var match = value.match(/^(\-?\d+(?:\.\d+)?)(?:px|(\%))?$/);	

					if(match) {

						value = parseInt(match[1]);
						if(match[2]) value = value / 100;

					} else value = 0;
				}
			}


			if(value < 1 && value > -1) return Math.floor(avalSize * value);
			else return value;

		};
	
	
		var adjustToWindowSize = function() {
			
			var windowSize = {
				width: window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth||0, 
				height: window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight||0
			};
			
			contentNode.find('.' + jQuery.fixedStaticBlock.buttonCloseBlockClassname).height('');
			
			contentNode.repaintAll();
			
			var contentNodeWidth = contentNode.width();
			var contentNodeHeight = contentNode.height();

			//contentNode.find('.' + jQuery.fixedStaticBlock.buttonCloseBlockClassname).height(contentNodeHeight);
			//contentNode.find('.' + jQuery.fixedStaticBlock.contentBlockClassname).height(contentNodeHeight);
			//contentNode.find('.' + jQuery.fixedStaticBlock.buttonCloseBlockClassname + ' a').css({'top': Math.round(contentNodeHeight/2)-8});

			if(opts.left != null) {
				contentNodePos['left'] = _parsePositionValue(opts.left, windowSize.width - contentNodeWidth);
			} else {
				contentNodePos['left'] = null;
			}
			
			if(opts.right != null) {
				contentNodePos['right'] = _parsePositionValue(opts.right, windowSize.width - contentNodeWidth);
			} else {
				contentNodePos['right'] = null;
			}

			if(opts.top != null) {
				contentNodePos['top'] = _parsePositionValue(opts.top, windowSize.height - contentNodeHeight);
			} else {
				contentNodePos['top'] = null;
			}
			
			if(opts.bottom != null) {
				contentNodePos['bottom'] = _parsePositionValue(opts.bottom, windowSize.height - contentNodeHeight);
			} else {
				contentNodePos['bottom'] = null;
			}
			
			
			if(contentNodePos['top'] == null && contentNodePos['bottom'] == null) {
				contentNodePos['top'] = _parsePositionValue(jQuery.fixedStaticBlock.defaultTop, windowSize.height - contentNodeHeight);
			}
			
			if(contentNodePos['left'] == null && contentNodePos['right'] == null) {
				contentNodePos['left'] = _parsePositionValue(jQuery.fixedStaticBlock.defaultLeft, windowSize.width - contentNodeWidth);
			}
			
			adjustToWindowScroll();
				
		};
		
		
		
		var adjustToWindowScroll = function() {
		
			var $window = $(window);
			
			if(contentNodePos['left'] != null) contentNode.css({'left': contentNodePos['left'] + $window.scrollLeft()});
			
			if(contentNodePos['right'] != null) contentNode.css({'right': contentNodePos['right'] - $window.scrollLeft()});
			
			if(contentNodePos['top'] != null) contentNode.css({'top': contentNodePos['top'] + $window.scrollTop()});
			
			if(contentNodePos['bottom'] != null) contentNode.css({'bottom': contentNodePos['bottom'] - $window.scrollTop()});
			
		};
		
		
		var listenerWindowSize = function() {
			adjustToWindowSize();
		};
		
		
		var listenerWindowScroll = function() {
			adjustToWindowScroll();
		};
		
		
		var addCloseButton = function() {
			
			var buttonBlock = contentNode.find('.' + jQuery.fixedStaticBlock.buttonCloseBlockClassname);
			
			if(buttonBlock.length == 0) {
				
				var block = $('<div />').addClass(jQuery.fixedStaticBlock.buttonCloseBlockClassname).prependTo(contentNode);
				var button = $('<a />').addClass('close-button').html('x').attr({'title': 'Cerrar', 'href': 'javascript:void(0)'}).appendTo(block);
				
				
			}
			
		};
		
		
		var removeCloseButton = function() {
			
			var buttonBlock = contentNode.find('.' + jQuery.fixedStaticBlock.buttonCloseBlockClassname);
			
			if(buttonBlock.length > 0) {
				buttonBlock.remove();				
			}			
			
		};
		
		/*------------------------------------------------------------------*/
		
		
		$this.setOptions = function(options) {
			
			opts = $.extend({}, opts, $.isPlainObject(options) ? options: {});
			
			if(opts.position != null) {
				
				opts.position = String(opts.position).toLowerCase().trim();
				
				var newPos = {'left': null, 'top': null, 'right': null, 'bottom': null};
				
				if(opts.position == jQuery.fixedStaticBlock.POSITION.LEFT_TOP) {
					newPos['left'] = 0;
					newPos['top'] = 0;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.LEFT_CENTER) {
					newPos['left'] = 0;
					newPos['top'] = 0.5;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.LEFT_BOTTOM) {
					newPos['left'] = 0;
					newPos['bottom'] = 0;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.RIGHT_TOP) {
					newPos['right'] = 0;
					newPos['top'] = 0;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.RIGHT_CENTER) {
					newPos['right'] = 0;
					newPos['top'] = 0.5;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.RIGHT_BOTTOM) {
					newPos['right'] = 0;
					newPos['bottom'] = 0;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.CENTER_TOP) {
					newPos['left'] = 0.5;
					newPos['top'] = 0;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.CENTER_CENTER) {
					newPos['left'] = 0.5;
					newPos['top'] = 0.5;
				} else if(opts.position == jQuery.fixedStaticBlock.POSITION.CENTER_BOTTOM) {
					newPos['left'] = 0.5;
					newPos['bottom'] = 0;
				}

				var positions = ['left','top','right','bottom'];
				
				$.each(positions, function(index, pos) {
					
					if(opts[pos] == null && newPos[pos] != null) {
						opts[pos] = newPos[pos];
					}
					
				});
				
			}
			
			if(opts.animation == null) {
				opts.animation = 0;
			}
			
			if(opts.animation != null && opts.showAnimation == null) {
				opts.showAnimation = opts.animation;
			}
			
			if(opts.animation != null && opts.hideAnimation == null) {
				opts.hideAnimation = opts.animation;
			}
		
		
			if(opts.closeButton) {
				addCloseButton();
			} else {
				removeCloseButton();
			}
		
		
			if(isVisible) {
			
				adjustToWindowSize();
			
			} else {
			
				if(opts.autoShow) {
					$this.show();
				}
				
			}

		};
		
		
		$this.getContent = function() {
			return contentNode;
		};
		
		$this.getNode = function() {
			return $this.getContent();
		};
		
		
		$this.show = function() {
			
			if(!isVisible) {
				
				adjustToWindowSize();
				
				contentNode.fadeIn(opts.showAnimation, function() {
					
					contentNode.triggerHandler('fixed-static-block-show');
					
					if(opts.onopen && typeof opts.onopen == 'function') {
						opts.onopen.call($this);
					}
					
					if(opts.onshow && typeof opts.onshow == 'function') {
						opts.onshow.call($this);
					}
					
				});
				
				$(window).bind('resize', listenerWindowSize);
				$(window).bind('scroll', listenerWindowScroll);
				
				isVisible = true;
				
				if(opts.closeTimeout != null && opts.closeTimeout > 0) {
					
					closeTimeout = setTimeout(function() { $this.hide(); }, opts.closeTimeout * 1000);
				}
			}
			
			return $this;
		};
		
		
		$this.hide = function() {
		
			if(isVisible) {

				$(window).unbind('resize', listenerWindowSize);
				$(window).unbind('scroll', listenerWindowScroll);
				
				contentNode.fadeOut(opts.hideAnimation, function() {
					
					contentNode.triggerHandler('fixed-static-block-hide');
					
					if(opts.onclose && typeof opts.onclose == 'function') {
						opts.onclose.call($this);
					}
					
					if(opts.onhide && typeof opts.onhide == 'function') {
						opts.onhide.call($this);
					}
					
				});
				
				isVisible = false;
				
				if(closeTimeout) {
					
					try { clearTimeout(closeTimeout); }
					catch(e) { } 		
					
				}
			}
			
			return $this;
		};
		
		
		$this.open = function() {
			return $this.show();
		};
		
		
		$this.close = function() {
			return $this.hide();
		};
		
		
		$this.reposition = function() {
			
			if(!isVisible) {
				adjustToWindowSize();
			}
			
			return $this;
		};
		
		
		$this.updateSize = function() {
			return $this.reposition();
			
		};
		
		/*-----------------------------------------------------------------*/
		
		$this.setOptions(opts);
		
		return $this;
	};
	
	
	jQuery.fixedStaticBlock.blockClassname = 'zwidget-fixed-static-block';
	jQuery.fixedStaticBlock.contentBlockClassname = 'zwidget-fixed-static-content-block';
	jQuery.fixedStaticBlock.buttonCloseBlockClassname = 'zwidget-fixed-static-button-close-block';
	
	jQuery.fixedStaticBlock.defaultLeft = 0.5;
	jQuery.fixedStaticBlock.defaultTop = 0.2;
	
	jQuery.fixedStaticBlock.zIndex = 500;
	
	jQuery.fixedStaticBlock.POSITION = {};
	jQuery.fixedStaticBlock.POSITION.LEFT_TOP = 'left top';
	jQuery.fixedStaticBlock.POSITION.LEFT_CENTER = 'left center';
	jQuery.fixedStaticBlock.POSITION.LEFT_MIDDLE = jQuery.fixedStaticBlock.POSITION.LEFT_CENTER;
	jQuery.fixedStaticBlock.POSITION.LEFT_BOTTOM = 'left bottom';
	jQuery.fixedStaticBlock.POSITION.CENTER_TOP = 'center top';
	jQuery.fixedStaticBlock.POSITION.CENTER_CENTER = 'center center';
	jQuery.fixedStaticBlock.POSITION.CENTER_MIDDLE = jQuery.fixedStaticBlock.POSITION.CENTER_CENTER;
	jQuery.fixedStaticBlock.POSITION.CENTER_BOTTOM = 'center bottom';
	jQuery.fixedStaticBlock.POSITION.RIGHT_TOP = 'right top';
	jQuery.fixedStaticBlock.POSITION.RIGHT_CENTER = 'right center';
	jQuery.fixedStaticBlock.POSITION.RIGHT_MIDDLE = jQuery.fixedStaticBlock.POSITION.RIGHT_CENTER;
	jQuery.fixedStaticBlock.POSITION.RIGHT_BOTTOM = 'right bottom';
	
	
	jQuery.fixedStaticBlock.defaultOptions = {
		top: null,
		left: null,
		right: null,
		bottom: null,
		closeTimeout: 0,
		classname: null,
		autoShow: false,
		position: null,
		animation: 200,
		showAnimation: null,
		hideAnimation: null,
		closeButton: false,
		onopen: null,
		onshow: null,
		onclose: null,
		onhide: null
	};
	
	
	jQuery.fn.fixedStaticBlock = function(opts){

		var $this = $(this);
		var obj = $this.data('__fixedStaticBlock__');

		if(!obj) {

			var $parent = $this.parent('.' + jQuery.fixedStaticBlock.blockClassname);
			
			if($parent.length > 0) {
			
				return $parent.fixedStaticBlock(opts);
				
			} else {

				obj = new jQuery.fixedStaticBlock(this, opts);
				$(this).data('__fixedStaticBlock__', obj);
				
			}

		} else {

			obj.setOptions(opts);

		}

		
		return obj;
	};

})(jQuery);
