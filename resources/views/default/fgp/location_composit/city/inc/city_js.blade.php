<script type="text/javascript">
$('#serviceProviderFilter1, #serviceProviderFilter').selectpicker({
    liveSearch: true,
    showTick: true,
    actionsBox: true,
});
// loadCookie('volunteers_advanced', '.advancedFormBtn');
loadCookie('stipend_item', '#quickFormBtn');
var vDatatableCity = $('#location_city_data_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/location/all/city',
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
            field:'city_name',
            title:'City Name',   
                   
        },
    
        {
            field: 'zip_code',
            title: 'Zip Code'
        },{
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
                return `<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/city/edit/${row.id}">\
                        <i class="la la-edit"></i></button>
                        
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/city/delete/${row.id}">\
                        <i class="la la-trash"></i></button>`;
            },
        },]
});


$(document).off('input','#city_name').on('input','#city_name',function (e) {
    e.preventDefault();
    if($(this).val().length >= 3){
        setCookie('city_data', JSON.stringify([{name: 'city_name', value: $(this).val()}]))
        vDatatableCity.search($(this).val(),'siteName');
    }
}).on('blur', '#city_name', function(e){
    e.preventDefault();
    e.stopPropagation();
    if($(this).val().length<3){
        $(this).val('');
        deleteCookie('city_data');
    }
});



</script>