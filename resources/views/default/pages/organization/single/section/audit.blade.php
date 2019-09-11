<div class="tab-pane" id="auditDetail" role="tabpanel">
    <div class="audit_datatable"></div>
</div>
<script type="text/javascript">
    var datatable = $('.audit_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/audits/all/organization/{{$organization->id}}',
                    method: 'GET'
                },
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 550,
            footer: false
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
            autoHide: false,
        },

        // columns definition
        columns: [
            {
                field: 'updated_at',
                title: 'Updated At',
                sortable: 'desc',
                template:function (row) {
                    return moment( row.updated_at).format(std.config.date_format);
                }
            },{
            	field: 'id',
            	title: 'Updated By',
            	template: function(row){
            		return row.client.fname+' '+row.client.lname;
            	}
            },{
                field: 'action',
                title: 'Action',
                width: 50,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/audit/view/' + row.id + '">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';
                },
            },]
    });
</script>