
(function(jQuery){
	
	
	
	jQuery.followMouseTitle = function(content, opts) {
		
		if(this == jQuery) return new jQuery.followMouseTitle(content, opts);
				
		/*------------------------------------------------------------------*/

		var opts = $.extend({}, jQuery.followMouseTitle.defaultOptions, opts);
		var $this = this;
		
		var rootNode = $(document.body);
		
		var alignXOffset = 0;
		var alignYOffset = 0;
		
		var visible = false;
		
		var block = $('<div />').
						css({'position': 'absolute', 'display': 'none', 'z-index': '9999999'}).
						appendTo(document.body);
		
		var block_content = $('<div />').
						addClass('follow-mouse-title ' + (opts['classname'] ? opts['classname'] : '')).
						appendTo(block);
					
					
		if(opts['css'])	{
			block_content.css(opts['css']);
		}
		
		var mouseEventHandler = function(event) {
			
			block.css({
				'top': event.pageY + opts['moveY'] + alignYOffset, 
				'left': event.pageX + opts['moveX'] + alignXOffset
			});
			
		};
		
		$this.show = function() {
		
				
			if(!visible) {	
			
				block.css({'opacity': 0, 'visibility': 'hidden'}).show();

				if(opts['alignX'].toLowerCase() == 'right') {
					alignXOffset = -block.outerWidth();				
				} else if(opts['alignX'].toLowerCase() == 'center') {
					alignXOffset = -(block.outerWidth()/2);				
				} else {
					alignXOffset = 0;
				}

				if(opts['alignY'].toLowerCase() == 'top') {
					alignYOffset = -block.outerHeight();				
				} else if(opts['alignY'].toLowerCase() == 'center' || opts['alignY'].toLowerCase() == 'middle') {
					alignYOffset = -(block.outerHeight()/2);				
				} else {
					alignYOffset = 0;
				}

				$(rootNode).bind('mousemove mouseover', mouseEventHandler);
				$(rootNode).trigger('mouseover');
				
				visible = true;

				setTimeout(function() {
					
					block.css({'visibility': 'visible'});
					block.animate({'opacity': 1}, opts['animation']);
					
				}, opts['timeout']);
				
			}
			
		};
		
		
		$this.hide = function() {
		
			visible = false;
			block.hide();
			$(rootNode).unbind('mousemove mouseover', mouseEventHandler);
		
		};
		
		
		
		$this.setContent = function(content) {
			
			block_content.html(content);
		}
					
		
		$this.block = block;
		$this.block_content = block_content;
		$this.setContent(content);
		
		return $this;
	};
	
	
	
	jQuery.followMouseTitle.defaultOptions = {
		classname: '',
		moveX: 0,
		moveY: -20,
		alignX: 'center',
		alignY: 'top',
		timeout: 100,
		animation: 100
		
	};
	
	
	jQuery.fn.followMouseTitle = function(content, opts){

		$(this).each(function() {

			var obj = $(this).data('__followMouseTitle__');

			if(!obj) {
				
				obj = new jQuery.followMouseTitle(content, opts);
				
				$(this).bind('mouseenter', function() { obj.show(); });
				
				$(this).bind('mouseleave', function() { obj.hide(); });
				
				
				$(this).add($(this).find('*')).each(function() {
					
					if($(this).attr('title')) {
						$(this).attr('title', null);
					}
					
				});
				
				
				$(this).data('__followMouseTitle__', obj);
								
			} else {
						
				obj.setContent(content);
				
			}
			
			$(this).trigger('mouseenter');
		});
		
		return $(this);
	};

	
})(jQuery);