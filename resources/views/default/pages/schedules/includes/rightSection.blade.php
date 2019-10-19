<div class="courtDetails row">
    <div class="col-12">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>:</th>
                <th>{{ $court->name }}</th>
                <th>&nbsp; &nbsp;</th>
                <th>Organization</th>
                <th>:</th>
                <th>{{ $court->organization->name }}</th>
            </tr>
            <tr>
                <th>Phone</th>
                <th>:</th>
                <th>{{ $court->contact->cell_phone??'' }}</th>
                <th>&nbsp; &nbsp;</th>
                <th>Email</th>
                <th>:</th>
                <th>{{ $court->contact->email??'' }}</th>
            </tr>
            <tr>
                <th>Address</th>
                <th>:</th>
                <th colspan="5">{{ $court->address ? $court->address->format() : '' }}</th>
            </tr>
        </table>
    </div>
</div>
<div>
    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist">
        <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scheduleTab" role="tab" aria-selected="true">
                Timesheets
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="scheduleTab">
            <table id="schedule_datable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Total Hrs</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($court->schedules as $item)
                        
                    @empty
                    <tr>
                        <td>
                            <input type="text" name="date[]" class="date_picker form-control form-control-sm w-100">
                            <label></label>
                        </td>
                        <td>
                            <input type="text" name="time_in[]" class="time_picker form-control form-control-sm w-100">
                        </td>
                        <td>
                            <input type="text" name="time_out[]" class="time_picker form-control form-control-sm w-100">
                        </td>
                        <td>
                            <input type="text" name="total_hrs[]" class="btn btn-sm btn-secondary total_hrs">
                        </td>
                        <td>
                            <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/organizations/15/edit" data-modal-callback="reloadOrg">
                                <i class="la la-plus"></i>
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {
        master_table('#schedule_datable').init({
            data: {
                type: 'local',
            },
            layout: {
                minHeight: '100px'
            },
            pagination: false,
            sortable: false
        });

        const dates = $('.date_picker').datepicker({
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        });

        dates.each(function(i, element) {
            const date = $(element).attr('data-date') || new Date();
            $(element).datepicker('setDate', date);
        });

        dates.off('change').on('change', function(e) {
            const day = moment(this.value, 'MM/DD/YYYY').format('MM/DD/YYYY');
            $(this).siblings('label').text(day);
        });

        const times = $('.time_picker').timepicker({
            autoclose: true,
            todayHighlight: true,
        });

        times.off('change').on('change', function(e) {
            
        });
    });
</script>