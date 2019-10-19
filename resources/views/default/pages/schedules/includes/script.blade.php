<script>
    $(function(Table) {

        master_table(Table).init({
            url : 'schedules/getData',
            columns: [
                {
                    field: 'id', title: '#', sortable: false, width: 30,
                    selector: { class: 'selected_schedule' }
                }
            ]
        });

    }( $('#schedule_datatable') ));
</script>