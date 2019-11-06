<script type="text/javascript">
var datatable = $('#organization_datatable').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/organization/all',
                method: 'GET'
            },
        },
        pageSize: 10,
        saveState: false,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
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
            field: 'cname',
            title: 'Name',
        },
        {
            field: 'add1',
            title: 'Primary Address',
            width: 180,
        },
        {
            field: 'zip_code',
            title: 'Zip'
        },
        {
            field: 'city',
            title: 'City',
            sortable: 'asc'
        },
        {
            field: 'state',
            title: 'State',
        },
        {
            field: 'phone',
            title: 'Phone',
        },
        {
            field: 'company_email',
            title: 'Email',
        },
        {
            field: 'no_of_vets',
            title: 'No of Vet',
        },
        {
            field: 'is_approved',
            title: 'Approved Status',
            template: function(row){
                if(row.is_approved){
                    return '<button class="m-badge m-badge--success m-badge--wide c-p">Approved</button>';
                }
                else{
                    return '<button class="m-badge m-badge--warning m-badge--wide c-p" data-modal-route="org_approval/'+row.id+'">Pending</button>';
                }
            }
        }, {
            field: 'agreement_status',
            title: 'Agreement',
            template: function(row){
                return '<button class="m-badge m-badge--info m-badge--wide c-p" data-modal-route="org_terms/'+row.tid+'">View</button';
            }
        },{
            field: 'action',
            title: 'Action',
            sortable: false,
            width: 180,
            template: function (row) {
                return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="org/single/'+row.id+'" title="View Application">' +
                    '<i class="la la-eye"></i>' +
                    '</button> &nbsp;\
                <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/organization/edit/' + row.id + '"><i class="la la-edit"></i></button> &nbsp;\
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"  data-modal-route=/organization/addClient/' + row.id + '">\
                        <i class="la la-user-plus"></i></button> \
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"  data-modal-title=" Delete Organization" data-modal-route=/organization/delete/' + row.id + '" data-modal-type="delete">\
                        <i class="la la-trash"></i></button>';
            },
        },
        {
            field: 'url',
            title: 'Website',
        }, ]
});


</script>