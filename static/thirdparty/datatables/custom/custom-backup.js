
LanguageHelper.GetDataTableLanguage = function()
{
    var language = {};
    language['lengthMenu'] = LanguageHelper.GetText('datatables_length_menu');
    language["zeroRecords"] = LanguageHelper.GetText('datatables_zero_records');
    language["info"] = LanguageHelper.GetText('datatables_info');
    language["infoEmpty"] = LanguageHelper.GetText('datatables_info_empty');
    language["infoFiltered"] = LanguageHelper.GetText('datatables_info_filtered');
    language["emptyTable"] = LanguageHelper.GetText('datatables_empty_table');
    language["loadingRecords"] = LanguageHelper.GetText('datatables_loading_records');
    language["search"] = LanguageHelper.GetText('datatables_search');
    language["searchPlaceholder"] = LanguageHelper.GetText('datatables_search_placeholder');
    language["thousands"] = LanguageHelper.GetText('datatables_thousands');
    language["decimal"] = LanguageHelper.GetText('datatables_decimal');
    language['paginate'] = {};
    language['paginate']["first"] = LanguageHelper.GetText('datatables_first');
    language['paginate']["last"] = LanguageHelper.GetText('datatables_last');
    language['paginate']["next"] = LanguageHelper.GetText('datatables_next');
    language['paginate']["previous"] = LanguageHelper.GetText('datatables_previous');

    return language;
};

jQuery.dataTableExt = {};

jQuery.dataTableExt.DefaultOptions =
{
    'enableFolders': false,
    'folderChildrenCountName': 'folder-children-count',
    'folderChildIndexName': 'folder-child-index',
    'folderParentIdName': 'folder-parent-id',
    'folderRowIdName': 'folder-row-id',
    'folderOpenedButtonHTML': '<span class="fa fa-minus-square-o"> </span>',
    'folderClosedButtonHTML': '<span class="fa fa-plus-square"> </span>',
    'openedNodes': []
};


jQuery.fn.dataTableExt = function(options)
{

    var $table = $(this);

    if($table.children('tbody').length == 0)
    {
        $table.append($('<tbody />'));
    }

    options = $.extend({}, {'language': LanguageHelper.GetDataTableLanguage()}, jQuery.dataTableExt.DefaultOptions, options);

    var dataTable = this.dataTable(options);

    if(options['enableFolders'])
    {
        $table.addClass('tree-table');
        $table.children('thead').children('tr:first').prepend($('<th />').addClass('folder-column').html('&nbsp;'));
        $table.children('tfoot').children('tr:first').prepend($('<th />').addClass('folder-column').html('&nbsp;'));
    }

    var openedNodes = options['openedNodes'];

    var headerRow = $table.children('thead').children('tr:first');

    function prepareRow(row, rowIndex, parentId)
    {
        var $row = $(row);

        if(options['enableFolders'])
        {
            if(!$row.children(':first').hasClass('folder-column'))
            {
                var openFolderIcon = $('<span />').addClass('openFolderIcon').html(options['folderClosedButtonHTML']).hide();
                var closeFolderIcon = $('<span />').addClass('closeFolderIcon').html(options['folderOpenedButtonHTML']).hide();
                var folderLink = $('<a />').attr({'href': 'javascript:void(0)'}).addClass('folderLink').append(openFolderIcon).append(closeFolderIcon).hide();

                $row.prepend($('<td />').addClass('folder-column').append(folderLink));
            }
        }

        if(options['enableFolders'])
        {
            var rowIndexInput = $('<input type="hidden" />').attr('name', options['folderChildIndexName']).val(rowIndex ? rowIndex : 0);
            var parentIdInput = $('<input type="hidden" />').attr('name', options['folderParentIdName']).val(parentId ? parentId : '');

            $row.children(':first').append(rowIndexInput).append(parentIdInput);

            var backgroundPosition = ((rowIndex ? rowIndex : 0) * 10) + 10;

            $row.children(0).css({
                'padding-left': String(backgroundPosition) + 'px'
            });

        }

        $row.children().each(function(index, cell){
            $(cell).addClass(headerRow.children().eq(index).attr('class'));
        });

    };

    function setFolderRowOpened(row, opened)
    {
        var $row = $(row);
        $row.find('.folderLink').css({'display': 'inline'});

        if(opened)
        {
            $row.find('.openFolderIcon').css({'display': 'none'});
            $row.find('.closeFolderIcon').css({'display': 'inline'});
        }
        else
        {
            $row.find('.openFolderIcon').css({'display': 'inline'});
            $row.find('.closeFolderIcon').css({'display': 'none'});
        }

    }

    this.on('draw.dt', function(){

        var paginateBlock = $(this).getParent('.dataTables_wrapper').find('.dataTables_paginate');
        var paginateButtons = paginateBlock.find('.paginate_button').length;

        if(paginateButtons > 3)
        {
            paginateBlock.show();
        }
        else
        {
            paginateBlock.hide();
        }

        $table.children('tbody').children().each(function(index, row){
            prepareRow(row, 0);
        });


        function updateRow(row)
        {

            if(options['enableFolders']) {

                var $this = $(row);
                $this.removeClass('openNode');
                $this.removeClass('closedNode');

                var childrenCountNode = $this.find('[name=' + jQuery.escapeSelector(options['folderChildrenCountName'])+']');
                var childrenCount = childrenCountNode.val();

                if (childrenCount > 0) {

                    $this.addClass('folderRow');

                    if (!$this.hasClass('closedNode') && !$this.hasClass('openNode')) {
                        $this.addClass('closedNode');
                    }

                    setFolderRowOpened(row, !$this.hasClass('closedNode'));

                    $this.find('.folderLink').bind('click', function (evt) {

                        var $this = $(this).getParent('td');
                        var row = $this.getParent();

                        if (row.hasClass('closedNode')) {

                            var data = row.paramMap();

                            if (!data[options['folderChildIndexName']]) {
                                data[options['folderChildIndexName']] = 1;
                            }
                            else {
                                data[options['folderChildIndexName']] = parseInt(data[options['folderChildIndexName']]) + 1;
                            }

                            var rowData = data;

                            $.ajax({
                                'url': options['ajax']['url'],
                                'type': 'post',
                                'data': data,
                                'success': function (data) {

                                    var lastRow = row;

                                    for (var i = 0; i < data['data'].length; i++) {

                                        var newRow = $('<tr />');

                                        for (var j = 0; j < data['data'][i].length; j++) {

                                            var cell = $('<td />').html(data['data'][i][j]);

                                            newRow.append(cell);
                                        }

                                        prepareRow(newRow, rowData[options['folderChildIndexName']]+1, rowData[options['folderRowIdName']]);

                                        var newRowChildrenCountNode = newRow.find('[name=' + jQuery.escapeSelector(options['folderChildrenCountName'])+']');
                                        var newRowChildrenCount = newRowChildrenCountNode.val();

                                        if (newRowChildrenCount > 0) {
                                            updateRow(newRow);
                                        }

                                        newRow.insertAfter(lastRow);

                                        lastRow = newRow;
                                    }
                                }
                            });

                            row.removeClass('closedNode');
                            row.addClass('openNode');
                            setFolderRowOpened(row, true);
                        }
                        else if (row.hasClass('openNode')) {

                            var row = $this.getParent();

                            function deleteRow(idParent) {
                                var rows = $table.find('tr');

                                rows.each(function (index, row) {

                                    var dataRow = $(row).paramMap();
                                    if (dataRow[options['folderParentIdName']] == idParent) {
                                        deleteRow(dataRow[options['folderRowIdName']]);
                                        $(row).remove();
                                    }
                                });
                            }

                            var data = row.paramMap();
                            deleteRow(data[options['folderRowIdName']]);

                            row.addClass('closedNode');
                            row.removeClass('openNode');
                            setFolderRowOpened(row, false);
                        }

                    });

                    var rowId = $this.find('[name=' + jQuery.escapeSelector(options['folderRowIdName'])+']').val();

                    if(openedNodes.length > 0 && rowId == openedNodes[0])
                    {
                        openedNodes.shift();
                        $this.find('.folderLink').click();
                    }
                }

            }

        };

        $(this).find('tbody tr').each(function (index, node){

            updateRow(node);
        });



    });

    return dataTable;
};

jQuery.fn.dataTableLanguage = jQuery.fn.dataTableExt;