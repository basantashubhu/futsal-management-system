<script type="text/javascript">
$('#serviceProviderFilter1, #serviceProviderFilter').selectpicker({
    liveSearch: true,
    showTick: true,
    actionsBox: true,
});
// loadCookie('volunteers_advanced', '.advancedFormBtn');
loadCookie('stipend_item', '#quickFormBtn');
var vDatatable = $('#location_state_data_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/location/all/state',
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
        autoHide: true,
    },
    // columns definition
    columns: [
       {
            field:'state_name',
            title:'State Name',   
                   
        },
        {
            field: 'state_code',
            title: 'State Code'
        },
        {
            field: 'is_active',
            title: 'Active',
            template: function(row){
                    if(row.is_active){
                        return '<span class="m-badge m-badge--success m-badge--wide c-p">Active</span>';
                    }
                    else{
                            return '<span class="m-badge m-badge--warning m-badge--wide c-p">Inactive</span>';
                        }
                }
        },
        {
            field: 'action',
            title: 'Action',
            template: function(row){
                return `<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/state/view/${row.id}">\
                        <i class="la la-eye"></i></button>

                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/state/edit/${row.id}">\
                        <i class="la la-edit"></i></button>
                        
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/state/delete/${row.id}">\
                        <i class="la la-trash"></i></button>`;
            },
        },

        ]
});


$(document).off('input','#stateName').on('input','#stateName,',function (e) {
    e.preventDefault();
    if($(this).val().length>=3){
        var name1 = $(this).attr("name");
        $('#stipendFilter').find('input[name!="'+name1+'"]').val('');
        setCookie('stipend_item', JSON.stringify([{name: name1, value: $(this).val()}]));
        // deleteCookie('volunteers_advanced');
        vDatatable.search($(this).val(),name1);
    }
}).on('blur', '#itemName,#itemCode', function(e){
    if($(this).val().length<3){
        $(this).val('');
        deleteCookie('stipend_item');
        reloadDatatable('#location_state_data_table');
    }
});
$(document).off('change','#serviceProviderFilter1').on('change','#serviceProviderFilter1',function (e) {
    e.preventDefault();
    $('#volunteersAdvancedFilter').find('input').val('');
    $('#volunteersAdvancedFilter').find('select').selectpicker('val', '');
    setCookie('volunteers_quick', JSON.stringify([{name: 'supervisor[]', value: $(this).val()}]));
    deleteCookie('volunteers_advanced');
    vDatatable.search($(this).val(),'supervisor');
})
$(document).off('click', '.advancedFormBtn').on('click', '.advancedFormBtn', function (e) {
    $('#volunteersFilter').find('input').val('');
    $('#volunteersFilter').find('select').selectpicker('val', '');
    var id = $(this).attr('data-target');
    data = [];
    var name = $('#volName').val();
    var cellPhone = $('#cellPhone').val();
    var email = $('#email').val();
    var ssnFilter = $('#ssnFilter').val();
    var add1 = $('#add1').val();
    var city = $('#city').val();
    var zipCode = $('#zipCode').val();
    
    var supervisor = $('#serviceProviderFilter').val();
    if(name!=''){
        data.push({name: 'vol_name', value: name});
    }
    if(cellPhone !=''){
        data.push({name: 'cellPhone', value: cellPhone});
    }
    if(email !=''){
        data.push({name: 'email', value: email});
    }
    if(ssnFilter!=''){
        data.push({name: 'ssnFilter', value: ssnFilter});
    }
    if(add1!=''){
        data.push({name: 'add1', value: add1});
    }
    if(city!=''){
        data.push({name: 'city', value: city});
    }
    if(zipCode!=''){
        data.push({name: 'zipCode', value: zipCode});
    }
    if(supervisor!=''){
        data.push({name: 'supervisor[]', value: supervisor});
    }
    // data.push({name: 'date_range', value: dateRange1});
    var close = $(this).attr('data-close');
    $('#'+close).click();
    vDatatable.setDataSourceParam('query', '');
    // $('#showApplicationAdvanceSearchDashboard1').click();
    deleteCookie('volunteers_quick');
    setCookie('volunteers_advanced', JSON.stringify(data));
    vDatatable.search(data, 'advancedFilter');
    $('#showApplicationAdvanceSearchDashboard').css('border', '1px solid red');
});
$(document).off('click', '#vol_data_table .m-datatable__cell--sort').on('click', '#vol_data_table .m-datatable__cell--sort', function (e) {
    var field = $(this).attr("data-field");
    var sort = $(this).attr("data-sort");
    $('.volunteerExporter').attr('data-sort-field', field);
    $('.volunteerExporter').attr('data-sort-value', sort);
    setCookie('sort',JSON.stringify([{name:field}]));
});
$(document).off('click', '.volunteerExporter').on('click', '.volunteerExporter', function (e) {
    var field = $(this).attr("data-sort-field");
    var value = $(this).attr("data-sort-value");
    var exporttype = $(this).attr('data-export-type');
    var url = 'volunteer/report/' + exporttype + '?';
    var data = '&sort_field='+field+'&sort_value='+value;
    window.open(url + data);
});

</script>