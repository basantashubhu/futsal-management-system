<script type="text/javascript">
loadCookie('zip_code', '#quickFormBtn');
$('#serviceProviderFilter1, #serviceProviderFilter').selectpicker({
    liveSearch: true,
    showTick: true,
    actionsBox: true,
});
loadCookie('volunteers_advanced', '.advancedFormBtn');
loadCookie('volunteers_quick', '#quickFormBtn');
var vDatatable = $('#location_data_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/locations/table-data',
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
            field: 'zip_code',
            title: 'Zip'
        },{
            field: 'state_name',
            title: 'State',
        }, 
        {
            field: 'county',
            title: 'County',
        },       
        {
            field: 'district',
            title: 'District',
        },        
        {
            field: 'city_name',
            title: 'City'
        },{
            field: 'action',
            title: 'Action',
            template: function(row){
                return `<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/edit/${row.id}">\
                        <i class="la la-edit"></i></button>
                        
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/location/delete/${row.id}">\
                        <i class="la la-trash"></i></button>`;
            },
        },]
});
//<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/volunteer/edit/${row.id}">\
//<i class="la la-edit"></i></button> &nbsp;\

$(document).off('input','#city_s,#county_s,#district_s,#zip_s').on('input','#city_s,#county_s,#district_s,#zip_s',function (e) {
    e.preventDefault();
    if($(this).val().length>=3){
        var name1 = $(this).attr("name");
        $('#locationFilter').find('input[name!="'+name1+'"]').val('');
        setCookie('zip_code', JSON.stringify([{name: name1, value: $(this).val()}]));
        vDatatable.search($(this).val(), name1);
    }
}).on('blur', '#city_s,#county_s,#district_s,#zip_s', function(e){
    if($(this).val().length<3){
        $(this).val('');
        deleteCookie('zip_code');
        reloadDatatable('#location_data_table');
    }
});

</script>