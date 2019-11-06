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
                @if($isEditable = $court->schedules->count())
                <button class="btn btn-sm m-btn btn-warning m-btn--icon m-btn--icon-only makeEditable" data-target="timesheetForm" data-id="#saveSingleTimesheet"
                    type="button">
                    <i class="la la-edit text-white"></i>
                </button>
                @endif
            </a>
        </li>
        <li class="nav-item m-tabs__item">
            <a href="javascript:;" class="nav-link m-tabs__link">
                <input type="text" class="form-control form-control-sm date_picker" data-date="{{ $date }}" style="width: 200px;">
            </a>            
        </li>
        <li class="nav-item m-tabs__item ml-auto">
            <a href="javascript:;" class="nav-link m-tabs__link">
                <button @if($isEditable) disabled @endif id="saveSingleTimesheet" type="button" 
                class="btn btn-success m-btn m-btn--pill">Save Timesheets</button>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="scheduleTab">
            <form action="javascript:;" id="timesheetForm">
                <input type="hidden" name="court_id" value="{{ $court->id }}">
                <input type="hidden" name="cal_date" value="{{ $date }}">
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
                            <tr>
                                <td>
                                    <input type="hidden" disabled name="timesheet_id[]" value="{{ $item->id }}">
                                    <input type="text" disabled readonly name="date[]" value="{{ date('m/d/Y', $tstr = strtotime($item->date)) }}" value="{{ date('m/d/Y') }}" class="form-control form-control-sm w-100">
                                    <label>{{ date('l', $tstr) }}</label>
                                </td>
                                <td>
                                    <input type="text" disabled name="time_in[]" value="{{ $item->time_in }}" class="time_picker form-control form-control-sm w-100">
                                </td>
                                <td>
                                    <input type="text" disabled name="time_out[]" value="{{ $item->time_out }}" class="time_picker form-control form-control-sm w-100">
                                </td>
                                <td>
                                    <input type="text" readonly disabled name="total_hrs[]" value="{{ date('G:i', strtotime($item->total_hrs)) }}" class="form-control form-control-sm total_hrs w-100">
                                </td>
                                <td>
                                    <button disabled class="btn addRow btn-sm m-btn btn-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                                        type="button">
                                        <i class="la la-plus"></i>
                                    </button>
                                    <button disabled class="btn removeRow btn-sm m-btn btn-danger m-btn--icon m-btn--icon-only m-btn--pill" 
                                        type="button">
                                        <i class="la la-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                        @php
                            $dt = strtotime($date);
                        @endphp
                        <tr>
                            <td>
                                <input type="text" readonly name="date[]" value="{{ date('m/d/Y', $dt) }}" class="form-control form-control-sm w-100">
                                <label>{{ date('l', $dt) }}</label>
                            </td>
                            <td>
                                <input type="text" name="time_in[]" class="time_picker form-control form-control-sm w-100">
                            </td>
                            <td>
                                <input type="text" name="time_out[]" class="time_picker form-control form-control-sm w-100">
                            </td>
                            <td>
                                <input type="text" readonly name="total_hrs[]" class="form-control form-control-sm total_hrs w-100">
                            </td>
                            <td>
                                <button class="btn addRow btn-sm m-btn btn-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                                    type="button">
                                    <i class="la la-plus"></i>
                                </button>
                                <button class="btn removeRow btn-sm m-btn btn-danger m-btn--icon m-btn--icon-only m-btn--pill" 
                                    type="button">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </form>
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

        $(document).off('click', '.addRow').on('click', '.addRow', function(e) {
            const myself = $(this).closest('tr');
            const clone = myself.clone();
            clone.find('input[name="timesheet_id[]"]').remove();
            myself.after(clone);

            dateTimeFunc();
            resetRows();
        });

        $(document).off('click', '.removeRow').on('click', '.removeRow', function(e) {
            $(this).closest('tr').remove();
            resetRows();
        });

        $(document).off('click', '#saveSingleTimesheet').on('click', '#saveSingleTimesheet', e => {
            confirmAction({
                btn: 'btn-success', action: 'Save',
                message : '<strong>Save timesheets schedule ?</strong>'
            }, () => {
                const form = document.getElementById('timesheetForm');
                const request = {
                    url: 'schedules/timesheet/save',
                    method: 'post',
                    data: new FormData(form)
                };
                sendAjax(request, function(response) {
                    toastr.success('Timesheet schedule created.');
                    $('#rightSection').html(response);
                }, function(errors) {
                    const response = errors.responseJSON;
                    $(form).find('input[name]')
                            .css('border-color', '#ccc');
                    if(errors.status === 422 && !response.message) {
                        for(let i in response) {
                            $(form).find('[data-row="'+ i +'"]').find('input[name="'+ response[i]['field'] +'[]"]')
                            .css('border-color', 'red');
                            toastr.error(response[i]['message']);
                        }
                    }
                })
            });
        });

        dateTimeFunc();
        dateFunc();
    });

    function dateFunc() {
        const dates = $('.date_picker').datepicker({
            autoclose: true,
            todayHighlight: true,
            // startDate: new Date()
        });

        dates.each(function(i, element) {
            const date = $(element).attr('data-date') || moment().format('YYYY-MM-DD');
            $(element).datepicker('setDate', moment(date, 'YYYY-MM-DD').format('MM/DD/YYYY'));
        });

        dates.off('change').on('change', function(e) {
            const request = {
                url: `schedules/create`,
                data: { 
                    court_id: {{ $court->id }}, 
                    date: moment(this.value, 'MM/DD/YYYY').format('YYYY-MM-DD') 
                }
            };
            sendAjax(request, function(response) {
                $('#rightSection').html(response);
            });
        });
    }

    function dateTimeFunc() {
        const times = $('.time_picker').timepicker({
            autoclose: true,
            todayHighlight: true,
        });

        times.off('change').on('change', function(e) {
            const ffmt = 'H:mm A';
            const parent = $(this).closest('tr');
            const time_in = parent.find('input[name="time_in[]"]');
            const time_out = parent.find('input[name="time_out[]"]');
            const total_hrs = parent.find('input[name="total_hrs[]"]');
            // console.log(time_in.val(), moment().format('HH:mm A'))
            if(moment(time_out.val(), ffmt).isBefore(moment(time_in.val(), ffmt))) {
                time_out.css('border-color', 'red');
                return total_hrs.val('');
            } else {
                time_out.css('border-color', '#ccc');
            }
            const diff = moment.duration(moment(time_out.val(), ffmt).diff(moment(time_in.val(), ffmt)));
            total_hrs.val([parseInt(diff.asHours()), diff.minutes()].join(':'));
        });
    }

    function resetRows() {
        $('#schedule_datable tbody tr').each(function(i, elem) {
            const addable = (i + 1) % 2 == 0 ? 'even' : 'odd';
            const removable = addable === 'even' ? 'odd' : 'even';
            $(elem).removeClass(removable).addClass(addable).attr('data-row', i);
        });
    }
</script>