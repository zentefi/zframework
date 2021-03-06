
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

jQuery.fn.dataTableOriginal = jQuery.fn.dataTable;

jQuery.fn.dataTable = function(options)
{
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

    
    options = $.extend({}, {'language': LanguageHelper.GetDataTableLanguage()}, options);

    return $(this).dataTableOriginal(options);
};
