
jQuery.listMenu = function(node, options)
{
    var $this = $(node);
    options = $.extend({}, jQuery.listMenu.defaultOptions, options);

    $this.triggerHandler('listMenu.init');

    $this.bind('listMenu.clickItem', function() {

        var closed = true;

        $(this).find('.menu-submenu-link > a').each(function(index, item) {

            var link = $(item);
            var ul = link.next();

            if(ul.hasClass('visible'))
            {
                closed = false;
                return false;
            }
        });

        $this.triggerHandler('listMenu.closeAll', closed);
    });

    $this.bind('listMenu.hideAll', function() {

        $this.find('.menu-submenu-link > a').each(function(index, item) {

            var link = $(item);
            var ul = link.next();

            if(ul.is(':visible'))
            {
                ul.removeClass('visible').slideUp();
                link.find('.icon').removeClass('fa-minus-square').addClass('fa-plus-square');
                $this.triggerHandler('listMenu.hideItem', ul);
            }
        });

        $this.triggerHandler('listMenu.clickItem');
    });

    $this.find('.menu-submenu-link ul').hide();

    $this.find('.menu-submenu-link > a').bind('click', function() {

        var link = $(this);
        var ul = link.next();

        if(options['resumeUnique'] && ul.children().length == 1)
        {
            var link = ul.find('li a');

            if(link.attr('href'))
            {
                location.href = link.attr('href');
            }

            link.trigger('click');

        }
        else
        {
            if(ul.is(':visible'))
            {
                ul.removeClass('visible').slideUp();
                link.find('.icon').removeClass('fa-minus-square').addClass('fa-plus-square');
                $this.triggerHandler('listMenu.hideItem', ul);
            }
            else
            {
                ul.addClass('visible').slideDown();
                link.find('.icon').removeClass('fa-plus-square').addClass('fa-minus-square');
                $this.triggerHandler('listMenu.showItem', ul);
            }
        }

        $this.triggerHandler('listMenu.clickItem');
    });

    if($this.hasClass('horizontal') || $this.hasClass('menu-horizontal'))
    {
        $this.find('.menu-submenu-link ul').css({
            //'display': 'block',
            'position': 'absolute'
        });

        $this.find('.menu-submenu-link ul li').css({
            'display': 'block'
        });
    }

    if($this.hasClass('vertical') || $this.hasClass('menu-vertical'))
    {
        $this.find('.menu-submenu-link > a').prepend("<span class='icon fa fa-plus-square'></span>&nbsp;&nbsp;");

        $this.find('.menu-submenu-link li.active').getParent('li.menu-item').find('a .icon').removeClass('fa-plus-square').addClass('fa-minus-square');

    }

    if(options['resumeUnique'])
    {
        $this.find('.menu-submenu-link > a').each(function(index, item) {

            var submenu = $(this).next();

            if(submenu.children().length == 1)
            {
                submenu.getParent().addClass('unique');
                submenu.getParent().children('a').find('.icon').hide();
            }

        });
    }

    $this.find('.menu-sublink.active').getParent().getParent().addClass('active');

    if(options['resumeUnique'])
    {
        var submenuItemActive = $this.find('.menu-sublink.active');

        if(submenuItemActive.length > 0)
        {
            var submenuListActive = submenuItemActive.getParent();

            if(submenuListActive.children().length > 1)
            {
                $this.find('.menu-sublink.active').parents().not($this).show();
                submenuListActive.getParent().addClass('active');
            }
        }
    }
    else
    {
        $this.find('.menu-sublink.active').parents().not($this).show();
        $this.find('.menu-sublink.active').getParent().getParent().addClass('active');
    }



};

jQuery.listMenu.defaultOptions = {
    'resumeUnique': true
};


jQuery.fn.listMenu = function(options) {
    $.listMenu(this, options);
    return this;
};
