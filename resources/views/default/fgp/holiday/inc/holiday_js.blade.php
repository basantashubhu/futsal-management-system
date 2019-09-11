<script type="text/javascript">
loadCookie('holiday_quick', '#holidaySearchBtn');
loadCookie('holi_advanced', '.submitHolidayFilter');
    $('#holiday_type, #statusFilter').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true,
    });
    var datatable = $('#holiday_data_table').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/holidays/all',
                    method:'GET'
                },
            },
            pageSize: 50,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            scroll: false,
            smoothScroll: {
                scrollbarShown: false
            }
        },
        // column sorting
        sortable: true,
        pagination: true,
        toolbar: {
            // toolbar items
            items: {
                // pagination
                pagination: {
                    // page size select
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },
        search: {
            input: $('#generalSearch'),
        },
        rows: {
            // auto hide columns, if rows overflow
            autoHide: false,
        },
        // columns definition
        columns: [
            {
                field: 'name',
                title: 'Holiday Name',
                sortable: 'asc',
            },{
                field:'hol_date',
                title:'Date',                        
                sortable: 'asc',
                template: function(row){
                    if(row.hol_date){
                        return moment(row.hol_date).format(std.config.date_format);
                        }
                }
            },{
                field:'state_r',
                title:'State',                       
            },{
                field:'cal_type',
                title:'Type',                       
            },
            {
                field :'eto_eligibility',
                title: 'ETO Eligibility',
                template: function(row){
                    if(row.eto_eligibility){
                        return "Yes";
                    }else{
                        return "No";
                    }
                }
            },  
            {
                field: 'description',
                title: 'Description'
            },
            {
                field: 'action',
                title: 'Action',
                template: function(row){
                    return '@canAccess("holiday", "edit")<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/holiday/edit/'+row.id+'">\
                            <i class="la la-edit"></i></button>@endcanAccess @canAccess("holiday", "delete")<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/holiday/delete/modal/'+row.id+'">\
                            <i class="la la-trash"></i></button>@endcanAccess';
                },
            },]
    });

    $(document).off('input','#holiday_name').on('input','#holiday_name',function (e) {
        e.preventDefault();
        if($(this).val().length>=3){
            // $('#holiday_Filter').find('input').val('');
            $('#holiday_Filter').find('select').selectpicker('val', '');
            setCookie('holiday_quick', JSON.stringify([{name: 'name', value: $(this).val()}]));
            deleteCookie('holiday_advanced');
            datatable.search($(this).val(),'name');
        }
    }).on('blur', '#holiday_name', function(e){
        if($(this).val().length<2){
            $(this).val('');
            deleteCookie('holiday_quick');
            reloadDatatable('#holiday_data_table');
        }
    });    

    $(document).off('input','#eto_eli').on('input','#eto_eli',function (e) {
        e.preventDefault();
        if($(this).val().length>=1){
            // $('#holiday_Filter').find('input').val('');

            setCookie('holiday_quick', JSON.stringify([{name: $(this).attr('name'), value: $(this).val()}]));
            deleteCookie('holiday_advanced');
            datatable.search($(this).val(),'eto_eli');
        }
    }).on('blur', '#eto_eli', function(e){
        if($(this).val().length<2){
            $(this).val('');
            deleteCookie('holiday_quick');
            reloadDatatable('#holiday_data_table');
        }
    });

    $(document).off('input','#holiday_state').on('input','#holiday_state',function (e) {
        e.preventDefault();
        if($(this).val().length>=3){
            $('#holiday_Filter').find('select').selectpicker('val', '');
            setCookie('holiday_quick', JSON.stringify([{name: 'state', value: $(this).val()}]));
            deleteCookie('holiday_advanced');
            datatable.search($(this).val(),'name');
        }
    }).on('blur', '#holiday_state', function(e){
        if($(this).val().length<2){
            $(this).val('');
            deleteCookie('holiday_quick');
            reloadDatatable('#holiday_data_table');
        }
    });

    $(document).off('change','#holiday_type').on('change','#holiday_type',function (e) {
        e.preventDefault();
        $('#holiday_Filter').find('input').val('');
        // $('#volunteersAdvancedFilter').find('select').selectpicker('val', '');
        setCookie('holiday_quick', JSON.stringify([{name: 'type[]', value: $(this).val()}]));
        deleteCookie('holi_advanced');
        datatable.search($(this).val(),'type'); 
    });

    $(document).off('click', '.m-datatable__cell--sort').on('click', '.m-datatable__cell--sort', function (e) {
        var field = $(this).attr("data-field");
        var sort = $(this).attr("data-sort");
        $('.holidayExporter').attr('data-sort-field', field);
        $('.holidayExporter').attr('data-sort-value', sort);
    });

    $(document).off('click', '.holidayExporter').on('click', '.holidayExporter', function (e) {
        var field = $(this).attr("data-sort-field");
        var value = $(this).attr("data-sort-value");
        var exporttype = $(this).attr('data-export-type');
        var url = 'holiday/report/' + exporttype + '?';
        var data = '&sort_field='+field+'&sort_value='+value;
        window.open(url + data);
    });

    $(document).off('click','#btnHolidayAdvanceSearch').on('click','#btnHolidayAdvanceSearch',function(e){
        let id = $(this).attr('data-target');
        const holidayData = $('#holidayAdvancedFilter').serializeArray();
        deleteCookie('holiday_quick');
        deleteCookie('holiday_advanced');
        setCookie('holiday_advanced',JSON.stringify(holidayData));
        datatable.search();
    });

     $(document).off('click','.btnRefresh').on('click','.btnRefresh',function(e) {
       
         deleteCookie('holiday_quick');
        deleteCookie('holiday_advanced');
    });
</script>