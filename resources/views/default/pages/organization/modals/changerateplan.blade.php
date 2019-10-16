@php
    if (! $organization->plan_id){
        $organization->plan_id = 0;
    }
@endphp
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Select Rate Plan
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">

            <div class="rpDatatable"></div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer" style="display: inline-block;">
            <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal" style="float: left;">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="SaveRatePlan"
                    data-target="organizationCreate">
                Change
            </button>
        </div>
    </div>
</div>

<script>
    BootstrapDatetimepicker.init();
    BootstrapSelect.init();

    var activerp =
            {{$organization->plan_id}}
    var rpdatatable = $('.rpDatatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/rate_plan/all',
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
                beforeTemplate: function (row, data, index) {
                    if (data.id == activerp) {
                        row.addClass('active_row');
                    }
                },
                // auto hide columns, if rows overflow
                autoHide: false,
            },
            // columns definition
            columns: [
                {
                    field: 'plan_name',
                    title: 'Plan Name',
                    sortable: 'asc',
                    template: function (row) {
                        return '<span class="containsSPid" data-rp="' + row.id + '">' + row.plan_name + '</span>'
                    }
                },
                {
                    field: 'start_date',
                    title: 'Start Date',
                    sortable: false,
                    width: 68,
                    template: function (row) {
                        return moment(row.start_date).format(std.config.date_format);
                    }
                },
                {
                    field: 'end_date',
                    title: 'End Date',
                    sortable: false,
                    width: 68,
                    template: function (row) {
                        return moment(row.end_date).format(std.config.date_format);
                    }
                },
            ]
        });


    function selectActive() {

    }

    $(document).off('click', '#SaveRatePlan').on('click', '#SaveRatePlan', function (e) {
        var selectedPlan = SelectPlan();
        ajaxRequest({
                url: "/organization/changerp/{{$organization->id}}",
                method: "POST",
                data: {
                    'active': selectedPlan
                }
            }, function (response) {
                processForm(response);
                routes.executeRoute('org/single/{id}', {
                    url: 'org/single/{{$organization->id}}'
                })
            }
        )
    });

    function SelectPlan() {
        var s = $('.rpDatatable').first().find('.active_row').first();
        s = $(s).find('.containsSPid').first().attr('data-rp');
        return s;
    }

</script>