<script type="text/javascript">
    var orgId=$('#organizationViewBoard').attr('data-org-id');


//    Vet Datatable initialization
 $('#org_vet_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/org/getAllVet/'+orgId,
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
            autoHide: false,
        },

        // columns definition
        columns: [
            {
                field: 'vet_lic',
                title: 'Licence No',
            }, {
                field: 'id',
                title: 'Vet Id',
            },
            {
                field: 'client_name',
                title: 'Name',
            },{
                field: 'company_email',
                title: 'Email',
                template:function (row) {
                    if(!row.imported){
                        if(row.company_email==null || row.company_email=='' )
                            return row.personal_email;
                        else
                            return row.company_email
                    }
                    return '-';
                },
            }
            ,{
                field:'phone',
                title:'Contact No',
                template:function (row) {
                    if(row.phone==null || row.phone=='')
                        return row.cell_phone;
                    else
                        return row.phone;
                }
            },{
                field: 'action',
                title: 'Action',
                sortable: false,
                width: 180,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="vetSingle/'+row.id+'" title="View Vet">' +
                            '<i class="la la-eye"></i>' +
                            '</button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/veterinarian/edit/'+row.id+'" title="View Vet">' +
                            '<i class="la la-edit"></i>' +
                            '</button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="veterinarian/delete/'+row.id+'" title="View Vet">' +
                            '<i class="la la-trash"></i>' +
                            '</button>&nbsp;';
                },
            }, ]
    });


//  Rate plan table initilization
    var ratePlanId=$('#rate_datatable').attr('data-rate-id');
    $('#rate_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/rate/all/'+ratePlanId,
                    method: 'GET'
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
                field: 'rate_type_name',
                title: 'Rate Name',
                sortable: 'asc',
                width: 200,
                className: 'text-capitalize',
                tempalte: function(row){
                    return row.rate_type_name.ucfirst();
                }
            },
            {
                field: 'treatment_name',
                title: 'Procedure Name',
                sortable: 'asc',
                width: 150,
                tempalte: function(row){
                    return row.treatment_name.ucfirst();
                }
            },
            {
                field: 'animal_type',
                title: 'Animal Type',
                sortable: 'asc',
                width: 100,
                tempalte: function(row){
                    return row.animal_type.ucfirst();
                }
            },
            {
                field: 'sex',
                title: 'Sex',
                width: 100,
                tempalte: function(row){
                    return row.sex.ucfirst();
                }
            },
            {
                field: 'cost',
                title: 'Cost',
                width: 100,
                textAlign: 'right',
                template:function (row) {
                    return '$'+row.cost.toFixed(2);
                }
            },]
    });

    //fileDownload
$(document).off('click','.uploadedDownload').on('click','.uploadedDownload',function () {
    var id = $(this).attr('data-id');
    var url = '/file/download/' + id;
    window.open(url);
})
</script>