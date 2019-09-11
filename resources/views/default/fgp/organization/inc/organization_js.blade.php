<script type="text/javascript">
loadCookie("pay_period_quick", '#searchBtn');
loadDateCookie('pay_period_quick','#searchBtn', 'payPeriodDateRangePicker');
var periodDatatable = $('#orgn_data_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/fgp/organization/all',
                method:'GET'
            },
        },
        pageSize: 20,
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
            title: 'Company Name',
            
        },
        {
            field: 'code',
            title: 'Company Code',
            
        }
        ,{
            field:'industry',
            title:'Industry',                        
        },{
            field:'estd_date',
            title:'Established Date',   
            template: function (row) {
            if(row.estd_date){
                    return moment(row.estd_date).format(std.config.date_format);
                }
            }
                     
        },
        {
            field: 'is_active',
            title: 'Status',
            template: function(row){
                if(row.is_active){
                    return '<span class="m-badge m-badge--success m-badge--wide c-p">Active</span>';
                }
                else{
                        return '<span class="m-badge m-badge--warning m-badge--wide c-p">Inactive</span>';
                    }
            }
        }, {
            field: 'action',
            title: 'Action',
            template: function(row){
                return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only  m-btn--pill"     data-modal-route="/fgp/organization/edit/'+row.id+'">\
                    <i class="la la-edit"></i></button>'+
                    '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"     data-modal-route="/fgp/organization/delete/'+row.id+'">\
                        <i class="la la-trash"></i></button>';
            },
        },]
});
$(document).off('input','#payCode').on('input','#payCode',function (e) {
    e.preventDefault();
    if($(this).val().length >=3){
        setCookie('pay_period_quick', JSON.stringify([{name: 'pay_code', value: $(this).val()}]));
        periodDatatable.search($(this).val(),'pay_code');
    }
}).on('blur', '#payCode', function(e){
    if($(this).val().length<3){
        $(this).val('');
        deleteCookie('pay_period_quick');
        reloadDatatable('#orgn_data_table');
    }
});
$('#payPeriodDateRangePicker').on('apply.daterangepicker', function (ev, picker) {
    $('#payCode').val('');
    var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
    setCookie('pay_period_quick', JSON.stringify([{name: 'date_range', value: dateRange}]));
    periodDatatable.search(dateRange,'date_range');
});
$(document).off('click', '.m-datatable__cell--sort').on('click', '.m-datatable__cell--sort', function (e) {
    var field = $(this).attr("data-field");
    var sort = $(this).attr("data-sort");
    $('.payPeriodExporter').attr('data-sort-field', field);
    $('.payPeriodExporter').attr('data-sort-value', sort);
    setCookie('sort',JSON.stringify([{name:field}]));
});
$(document).off('click', '.payPeriodExporter').on('click', '.payPeriodExporter', function (e) {
    var field = $(this).attr("data-sort-field");
    var value = $(this).attr("data-sort-value");
    var exporttype = $(this).attr('data-export-type');
    var url = 'pay_period/report/' + exporttype + '?';
    var data = '&sort_field='+field+'&sort_value='+value;
    window.open(url + data);
});
</script>