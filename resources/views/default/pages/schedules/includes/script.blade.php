<script>
    $(function(Table) {

        var scheduleTable = master_table(Table).init({
            url : 'schedules/getData',
            query: {
                query: { date: moment().format('MM/DD/YYYY') }
            },
            columns: [
                { field: 'id', title: '#', sortable: false, width: 30,
                    selector: { class: 'selected_schedule' }
                },
                { field: 'court', title: 'Court', width: 200 },
                { field: 'add1', title: 'location', width: 200,
                    template: ({add1, add2, city}) => `${ add1 },${ add2?add2+' - '+city:city }`
                },
                // { field: 'organization', title: 'Organization', width: 200 },
                { field: 'date', title: 'Date', width: 100 },
                // { field: 'time_in', title: 'Time In', width: 80 },
                // { field: 'time_out', title: 'Time Out', width: 80 },
                { field: 'total_hrs', title: 'Total Hrs', width: 80 },
                {
                    field: 'action', title: 'Action', width: 40, sortable: false,
                    template({court_id, date}) {
                        return (
                            `<button class="loadPage m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" 
                            data-route1="schedules/add?court_id=${court_id}&date=${date}" title="View Schedules">
                                <i class="la la-eye"></i>
                            </button>`
                        );
                    }
                }
            ]
        });

        $('#dateSchedule').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        .datepicker('setDate', 'now')
        .off('change')
        .on('change', function(e) {
            scheduleTable.search(this.value, 'date');
        });

    }( $('#schedule_datatable') ));
</script>