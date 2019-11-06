@includeWhen(!isset($no_pad), 'default.pages.organization.include.organizationhead')
@include('default.pages.organization.include.organizationbody', ['no_pad' => isset($no_pad)])

<script type="text/javascript">
    $(function (Table) {
        master_table(Table).init({
            url : 'organizations/getData',
            columns: [
                { 
                    field: 'id', title : '#', sortable : false, width : 30,
                    selector : { class : 'selected-courts' }
                },
                {
                    field: 'name', title: 'Name', width: 150,
                    template: ({ name }) => `<span title="${ name }">${ name }</span>`
                },
                // {
                //     field: 'industry', title: 'Industry', width: 100
                // },
                {
                    field: 'phone', title: 'Phone', width: 100
                },
                {
                    field: 'email', title: 'Email', width: 100,
                    template: ({ email }) => `<span title="${ email }">${ email }</span>`
                },
                {
                    field: 'website', title: 'Website', width: 150,
                    template: ({ website }) => `<span title="${ website }">${ website }</span>`
                },
                {
                    field: 'add1', title: 'Location', width: 150,
                    template({ add1, city }) {
                        return `${ add1 }, ${ city }`;
                    }
                },
                {
                    field: 'action', title: 'Action', width: 50, sortable: false,
                    template({ id }) {
                        return (
                            `<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                                data-modal-route="/organizations/${ id }/edit" data-modal-callback="reloadOrg">
                                <i class="la la-eye"></i>
                            </button>`
                        );
                    }
                }
            ],
            searchfield: $('#generalSearch')
        });
    }( $('#organization_datatable') ));

    function reloadOrg() {
        $('#organization_datatable').mDatatable('reload');
    }

</script>
